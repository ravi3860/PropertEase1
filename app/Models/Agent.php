<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'license_number',
        'agency_name',
    ];
    
    public function subscriptions() 
    {
        return $this->hasMany(Subscription::class, 'user_id')->where('user_type', 'agent');
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }

}
