<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = ['property_id', 'file_path', 'sort_order'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // convenience: return storage URL
    public function url()
    {
        return \Storage::disk('public')->url($this->file_path);
    }
}
