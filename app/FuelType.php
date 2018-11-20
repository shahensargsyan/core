<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    protected $table = 'fuel_types';
	
    protected $fillable = [
        'name', 
        'description',
        'image',
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
