<?php

namespace App\Http\Controllers;

use App\Models\Member;
use \App\Models\Agent;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactRequest;

class MemberController extends Controller
{
    // 📌 Get all members
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin can see all members
            return response()->json(Member::with('user')->get());
        }

        // Non-admin can only see their own profile
        $member = Member::with('user')->where('user_id', $user->id)->first();
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return response()->json($member);
    }

    // 📌 Get a single member by ID
    public function show($id)
    {
        $user = Auth::user();
        $member = Member::with('user')->findOrFail($id);

        if ($user->role !== 'admin' && $member->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($member);
    }

    // 📌 Update member details
    public function update(Request $request)
    {
        $user = $request->user();
        $member = Member::where('user_id', $user->id)->firstOrFail();

        // Ensure the logged-in user is updating their own profile
        if ($member->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate request
        $request->validate([
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'name'    => 'nullable|string|max:255',
            'email'   => 'nullable|email|max:255',
        ]);

        // Update member table
        $member->update($request->only(['phone', 'address']));

        // Update linked user record
        if ($request->has('name') || $request->has('email')) {
            $member->user->update($request->only(['name', 'email']));
        }

        // If no bearer token, it means request came from browser form (Blade)
        if (!$request->bearerToken()) {
            return redirect()->route('member.dashboard')->with('success', 'Profile updated successfully.');
        }

        // If API request (with Sanctum token), return JSON
        return response()->json([
            'message' => 'Member updated successfully',
            'member'  => $member->load('user')
        ]);
    }


    // 📌 Delete a member
    public function destroy($id)
    {
        $user = Auth::user();
        $member = Member::findOrFail($id);

        if ($user->role !== 'admin' && $member->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $member->delete();

        return response()->json(['message' => 'Member deleted successfully']);
    }

    public function dashboard()
    {
        $member = Member::where('user_id', Auth::id())->first();

        if (! $member) {
            return redirect()->route('home')->with('error', 'Member profile not found.');
        }

        $purchases = \App\Models\Purchase::with(['property', 'transactions', 'buyer.user', 'seller.user'])
        ->where(function ($q) use ($member) {
            $q->where('buyer_id', $member->id)
              ->orWhere('seller_id', $member->id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20); // optional pagination

        // Fetch all agents for the request form
        $agents = \App\Models\Agent::with('user')->get();

        // Fetch all contact requests made by this member
        $requests = ContactRequest::with('agent.user')
            ->where('member_id', $member->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.dashboard', compact('member', 'purchases', 'agents', 'requests'));

    }
}
