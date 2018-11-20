<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireplaceType extends Model
{
    protected $table = 'fireplace_types';
	
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
