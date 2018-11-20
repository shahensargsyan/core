<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireplaceOptionsAndAccessory extends Model
{
    protected $table = 'fireplace_options';
	
    protected $fillable = [
        'options_and_accessories_id', 
        'products_id'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    
}
