<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    // list purchases for authenticated member (buyer or seller)
    public function index(Request $request)
    {
        $member = $request->user()->member;
        $purchases = Purchase::with(['property', 'transactions'])
            ->where(function ($q) use ($member) {
                $q->where('buyer_id', $member->id)
                  ->orWhere('seller_id', $member->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('member.dashboard', compact('purchases', 'member'));
    }

    // show single purchase (buyer/seller/admin)
    public function show(Request $request, Purchase $purchase)
    {
        $member = $request->user()->member;
        if ($purchase->buyer_id !== $member->id && $purchase->seller_id !== $member->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $purchase->load(['property', 'transactions', 'buyer', 'seller']);
        return response()->json($purchase);
    }

    // initiate purchase (creates purchase + pending transaction)
    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|integer|exists:properties,id',
            'deposit_percent' => 'nullable|numeric|min:0.01|max:100',
            'deposit_amount' => 'nullable|numeric|min:0.01',
            'contact_requested' => 'sometimes|boolean',
        ]);

        $member = $request->user()->member;
        if (! $member) {
            return redirect()->back()->with('error', 'Only members can buy properties');
        }

        $property = Property::lockForUpdate()->findOrFail($data['property_id']);

        if ($property->status !== 'available') {
            return redirect()->back()->with('error', 'Property is not available for purchase');
        }

        if ($property->member_id === $member->id) {
            return redirect()->back()->with('error', 'You cannot purchase your own property');
        }

        // determine deposit amount
        $price = (float) $property->price;
        $depositPercent = isset($data['deposit_percent']) ? (float) $data['deposit_percent'] : null;
        $depositAmount = isset($data['deposit_amount']) ? (float) $data['deposit_amount'] : null;

        // apply percentage if percent provided
        if ($depositPercent !== null) {
            $min = config('purchases.min_deposit_percent', 5);
            $max = config('purchases.max_deposit_percent', 30);
            if ($depositPercent < $min || $depositPercent > $max) {
                return redirect()->back()->with('error', "Deposit percent must be between {$min} and {$max}");
            }
            $calculated = round($price * ($depositPercent / 100), 2);
            $depositAmount = $calculated;
        } elseif ($depositAmount === null) {
            return redirect()->back()->with('error', 'Either deposit percent or deposit amount is required');
        } else {
            // if deposit_amount given, calculate percent for record (optional)
            $depositPercent = round(($depositAmount / max($price, 1)) * 100, 2);
        }

        // apply deposit cap
        $cap = config('purchases.deposit_cap', 10000000);
        if ($depositAmount > $cap) {
            $depositAmount = $cap;
            // recalc percent representation
            $depositPercent = round(($depositAmount / max($price, 1)) * 100, 2);
        }

        // platform fee (if used)
        $platformFeePercent = config('purchases.platform_fee_percent', 0);
        $platformFee = round($depositAmount * ($platformFeePercent / 100), 2);

        // create purchase & pending transaction inside DB transaction
        $purchase = null;
        DB::transaction(function () use (&$purchase, $property, $member, $depositPercent, $depositAmount, $platformFee, $data) {
            $purchase = Purchase::create([
                'property_id' => $property->id,
                'buyer_id' => $member->id,
                'seller_id' => $property->member_id,
                'price_at_purchase' => $property->price,
                'deposit_percent' => $depositPercent,
                'deposit_amount' => $depositAmount,
                'platform_fee' => $platformFee,
                'status' => 'pending_payment',
                'contact_requested' => $data['contact_requested'] ?? false,
            ]);

            Transaction::create([
                'purchase_id' => $purchase->id,
                'provider' => 'manual',
                'provider_charge_id' => null,
                'amount' => $depositAmount,
                'currency' => 'LKR',
                'status' => 'pending',
                'meta' => null,
            ]);
        });

        return redirect()->route('member.purchases.index')
    ->with('success', 'Purchase initiated. Deposit pending. You can confirm it now.');
    }

    // confirm deposit/payment (simulate gateway callback) -> marks deposit_paid and reserves property
    public function confirm(Request $request, Purchase $purchase)
    {
        $member = $request->user()->member;
        if ($purchase->buyer_id !== $member->id) {
            return redirect()->back()->with('error', 'Forbidden');
        }

        if ($purchase->status !== 'pending_payment') {
            return redirect()->back()->with('error', 'Purchase is not pending payment');
        }

        DB::transaction(function () use ($purchase) {
            // mark the pending transaction as paid (first pending)
            $tx = $purchase->transactions()->where('status', 'pending')->first();
            if ($tx) {
                $tx->update(['status' => 'paid', 'provider_charge_id' => 'manual-' . now()->timestamp]);
            } else {
                // create a paid transaction if none exists
                $purchase->transactions()->create([
                    'provider' => 'manual',
                    'provider_charge_id' => 'manual-' . now()->timestamp,
                    'amount' => $purchase->deposit_amount,
                    'currency' => 'LKR',
                    'status' => 'paid',
                ]);
            }

            // update purchase status and reserve property
            $purchase->status = 'deposit_paid';
            $purchase->reserved_until = now()->addDays(config('purchases.reservation_days', 7));
            $purchase->save();

            $property = $purchase->property;
            $property->status = 'reserved';
            $property->save();
        });

        return redirect()->route('member.purchases.index')
    ->with('success', 'Deposit confirmed and property reserved.');
    }

    // mark full settlement completed (buyer or seller can call)
    public function markSettled(Request $request, Purchase $purchase)
    {
        $member = $request->user()->member;
        if ($member->id !== $purchase->buyer_id && $member->id !== $purchase->seller_id) {
            return redirect()->back()->with('error', 'Forbidden');
        }

        if (! in_array($purchase->status, ['deposit_paid', 'reserved', 'awaiting_settlement'])) {
            return redirect()->back()->with('error', 'Purchase cannot be marked settled in its current state');
        }

        DB::transaction(function () use ($purchase) {
            $purchase->status = 'completed';
            $purchase->save();

            $property = $purchase->property;
            $property->status = 'sold';
            $property->save();
        });

        return redirect()->route('member.purchases.index')
    ->with('success', 'Purchase marked as completed. Property status set to sold.');

    }

    // cancel a pending purchase (buyer may cancel before deposit paid)
    public function cancel(Request $request, Purchase $purchase)
    {
        $member = $request->user()->member;
        if ($purchase->buyer_id !== $member->id) {
            return redirect()->back()->with('error', 'Forbidden');
        }

        if ($purchase->status === 'pending_payment') {
            // safe to delete/cancel
            DB::transaction(function () use ($purchase) {
                // delete transactions
                $purchase->transactions()->delete();
                $purchase->delete(); // soft delete
            });

            return redirect()->route('member.purchases.index')->with('success', 'Purchase cancelled.');
        }

        return redirect()->back()->with('error', 'Cannot cancel purchase at this stage. Contact admin.');
    }
}
