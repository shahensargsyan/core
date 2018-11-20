<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
	
    protected $fillable = [
		'image',
		'name',
		'description', 
                'active'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
