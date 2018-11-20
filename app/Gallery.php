<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
	
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
