<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FireplaceWorkType extends Model
{
    protected $table = 'fireplace_work_types';
	
    protected $fillable = [
		'product_id', 
		'fireplace_type_id',
    ];
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function fireplaceTypes() {
        return $this->belongsToMany(FireplaceType::class);
    }

}
