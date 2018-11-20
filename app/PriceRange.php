<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceRange extends Model
{
    protected $table = 'price_ranges';
	
    protected $fillable = [
        'name', 
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
