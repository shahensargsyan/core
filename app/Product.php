<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	
    protected $fillable = [
        'name', 
        'description',
        'image',
        'cover_image',
        'additional_product_features',
        'product_code',
        'fuel_type_id',
        'fireplace_type_id',
        'fireplace_size_range_id',
        'heat_output_range_id',
        'price_range_id',
        'active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    
    public function fuelType() {
        return $this->belongsTo(FuelType::class);
    }
    
    public function fireplaceType() {
        return $this->belongsTo(FireplaceType::class);
    }
    
    public function fireplaceSizeRange() {
        return $this->belongsTo(FireplaceSizeRange::class);
    }
    
    public function heatOutputRange() {
        return $this->belongsTo(HeatOutputRange::class);
    }
    
    public function priceRange() {
        return $this->belongsTo(PriceRange::class);
    }
    
    public function options() {
        return $this->hasMany(OptionsAndAccessory::class);
    }
    
    public function documents() {
        return $this->hasMany(ProductDocument::class);
    }
}
