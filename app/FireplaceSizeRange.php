<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireplaceSizeRange extends Model
{
    protected $table = 'fireplace_size_ranges';
	
    protected $fillable = [
        'name', 
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
