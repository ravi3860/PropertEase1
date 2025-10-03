<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    public function properties() {
    return $this->hasMany(Property::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class, 'user_id')->where('user_type', 'member');
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

}
