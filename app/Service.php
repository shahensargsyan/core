<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'services';
	
    protected $fillable = [
        'name', 
        'image',
        'active',
        'description'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
