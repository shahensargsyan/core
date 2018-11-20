<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireplaceFuelType extends Model
{
    protected $table = 'fireplace_fuel_types';
	
    protected $fillable = [
		'product_id', 
		'fuel_type_id',
    ];
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function fuelTypes() {
        return $this->belongsToMany(FuelType::class);
    }

}
