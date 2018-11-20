<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    protected $table = 'product_documents';
	
    protected $fillable = [
		'product_id', 
		'name', 
		'file', 
		'active', 
    ];
}
