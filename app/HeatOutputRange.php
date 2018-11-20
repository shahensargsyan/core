<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeatOutputRange extends Model
{
    protected $table = 'heat_output_ranges';
	
    protected $fillable = [
        'name', 
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
