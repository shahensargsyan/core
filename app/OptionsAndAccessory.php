<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionsAndAccessory extends Model
{
    protected $table = 'options_and_accessories';
	
    protected $fillable = [
        'name', 
        'description',
        'product_id',
        'image',
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
