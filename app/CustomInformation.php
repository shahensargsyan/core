<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomInformation extends Model
{
    protected $table = 'custom_informations';
	
    protected $fillable = [
		'email', 
		'phone', 
		'address', 
		'about_text', 
		'facebook_link', 
		'instagram_link', 
		'twitter_link', 
		'google_plus_link', 
		'copyright', 
		'meta_title', 
		'meta_keywords', 
		'meta_description', 
		'yelp', 
    ];
}
