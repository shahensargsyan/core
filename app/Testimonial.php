<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
	
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
