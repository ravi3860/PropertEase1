<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'buyer_id',
        'seller_id',
        'price_at_purchase',
        'deposit_percent',
        'deposit_amount',
        'platform_fee',
        'status',
        'reserved_until',
        'contact_requested',
        'notes',
    ];

    protected $casts = [
        'deposit_percent' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'price_at_purchase' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'reserved_until' => 'datetime',
        'contact_requested' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Member::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(Member::class, 'seller_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isReserved(): bool
    {
        return $this->status === 'reserved' || $this->status === 'deposit_paid';
    }
}
