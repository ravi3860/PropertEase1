<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{

    protected $fillable = 
    ['member_id', 'agent_id', 'message', 'status', 'type'];

    public function member() {
        return $this->belongsTo(Member::class);
    }
    public function agent() {
        return $this->belongsTo(Agent::class);
    }
}
