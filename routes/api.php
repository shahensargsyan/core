<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('test', 'Api\ApiController@test')->name('test');

Route::get('getAllData', 'Api\ApiController@getAllData')->name('all_data');
Route::get('getCustomData', 'Api\ApiController@getCustomData')->name('custom_data');
Route::get('getServices', 'Api\ApiController@getServices')->name('get_services');
Route::get('getSliderImages', 'Api\ApiController@getSliderImages')->name('slider_images');
Route::get('getGalleryImages', 'Api\ApiController@getGalleryImages')->name('gallery_images');
Route::get('getFireplaceOptionsAndAccessories', 'Api\ApiController@getFireplaceOptionsAndAccessories')->name('get_fireplace_options_and_accessories');
Route::get('getFuelTypes', 'Api\ApiController@getFuelTypes')->name('get_fuel_type');
Route::get('getFireplaceTypes', 'Api\ApiController@getFireplaceTypes')->name('get_fireplace_type');
Route::get('getProducts', 'Api\ApiController@getProducts')->name('get_products');
Route::get('getTestimonials', 'Api\ApiController@getTestimonials')->name('get_testimonials');
Route::get('getFireplaceSizeRanges', 'Api\ApiController@getFireplaceSizeRanges')->name('get_fireplace_size_ranges');
Route::get('getHeatOutputRanges', 'Api\ApiController@getHeatOutputRanges')->name('get_heat_output_ranges');
Route::get('getPriceRanges', 'Api\ApiController@getPriceRanges')->name('get_price_ranges');
Route::post('getProductDetails', 'Api\ApiController@getProductDetails')->name('get_product_details');
Route::post('filterProducts', 'Api\ApiController@filterProducts')->name('filter_products');


Route::post('addSubscriber', 'Api\ApiController@addSubscriber')->name('add_subscriber');
Route::post('sendEmail', 'Api\ApiController@sendEmail')->name('send_email');

