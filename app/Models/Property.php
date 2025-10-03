<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id', 'title', 'slug', 'description', 'price', 'property_type',
        'address', 'city', 'state', 'postal_code', 'country',
        'bedrooms', 'bathrooms', 'area', 'year_built', 'status', 'is_published'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    // owner
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // images
    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }
}
