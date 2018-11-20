<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('user/activation/{token}', 'Api\ApiController@activateUser')->name('user.activate');

Route::get('admin', 'AdminController@index')->name('admin');


Route::get('/', 'AdminController@index')->name('home');

//Admin Panel
/* Start service */
Route::get('services', array(
    'as' => 'services',
    'uses' => 'AdminController@services'
));

Route::get('services/add/', array(
    'as' => 'services_add',
    'uses' => 'AdminController@servicesAdd'
));

Route::Put('services/add', array(
    'as' => 'services_add',
    'uses' => 'AdminController@servicesAddPost'
));

Route::get('services/edit/{id}', array(
    'as' => 'services_edit',
    'uses' => 'AdminController@servicesEdit'
));

Route::put('services/edit', array(
    'as' => 'services_edit',
    'uses' => 'AdminController@servicesEditPut'
));

Route::post('services/delete/{id}', array(
    'as' => 'services_delete',
    'uses' => 'AdminController@servicesDelete'
));
/* End service */


/* Start Slider */
Route::get('sliders', array(
    'as' => 'sliders',
    'uses' => 'AdminController@slider'
));

Route::get('sliders/add/', array(
    'as' => 'sliders_add',
    'uses' => 'AdminController@sliderAdd'
));

Route::post('sliders/add', array(
    'as' => 'sliders_add',
    'uses' => 'AdminController@sliderAddPost'
));

Route::get('sliders/edit/{id}', array(
    'as' => 'sliders_edit',
    'uses' => 'AdminController@sliderEdit'
));

Route::put('sliders/edit', array(
    'as' => 'sliders_edit',
    'uses' => 'AdminController@sliderEditPut'
));

Route::post('sliders/delete/{id}', array(
    'as' => 'sliders_delete',
    'uses' => 'AdminController@sliderDelete'
));
/* End Slider */

/* Start Subscribers */
Route::get('subscribers', array(
    'as' => 'subscribers',
    'uses' => 'AdminController@subscribers'
));

Route::post('subscribers/delete/{id}', array(
    'as' => 'subscribers_delete',
    'uses' => 'AdminController@subscribersDelete'
));

Route::get('subscribers/subscribersExportCsv', array(
    'as' => 'subscribers_export',
    'uses' => 'AdminController@subscribersExportCsv'
));
/* End Subscribers */


/* Custom Information */
Route::get('custom_information', array(
    'as' => 'custom_information',
    'uses' => 'AdminController@restInformation'
));

Route::get('custom_information/edit/{id}', array(
    'as' => 'custom_information_edit',
    'uses' => 'AdminController@restInformationEdit'
));

Route::put('custom_information/edit', array(
    'as' => 'custom_information_edit',
    'uses' => 'AdminController@restInformationEditPut'
));
/* Custom Information */



/* Start Subscribers */
Route::get('subscribers', array(
    'as' => 'subscribers',
    'uses' => 'Admin\SubscribersController@index'
));

Route::post('subscribers/delete/{id}', array(
    'as' => 'subscribers_delete',
    'uses' => 'Admin\SubscribersController@subscribersDelete'
));

Route::get('subscribers/subscribersExportCsv', array(
    'as' => 'subscribers_export',
    'uses' => 'Admin\SubscribersController@subscribersExportCsv'
));
/* End Subscribers */

Route::post('uploadSlimAvatar', array(
    'as' => 'uploadSlimAvatar',
    'uses' => 'AdminController@uploadSlimAvatar'
));

/* Start fuel types */
Route::get('fuel_types', array(
    'as' => 'fuel_types',
    'uses' => 'Admin\FuelTypesController@fuelTypes'
));

Route::get('fuel_types/add', array(
    'as' => 'fuel_types_add',
    'uses' => 'Admin\FuelTypesController@fuelTypesAdd'
));

Route::Put('fuel_types/add', array(
    'as' => 'fuel_types_add',
    'uses' => 'Admin\FuelTypesController@fuelTypesAddPost'
));

Route::get('fuel_types/edit/{id}', array(
    'as' => 'fuel_types_edit',
    'uses' => 'Admin\FuelTypesController@fuelTypesEdit'
));

Route::put('fuel_types/edit', array(
    'as' => 'fuel_types_edit',
    'uses' => 'Admin\FuelTypesController@fuelTypesEditPut'
));

Route::post('fuel_types/delete/{id}', array(
    'as' => 'fuel_types_delete',
    'uses' => 'Admin\FuelTypesController@fuelTypesDelete'
));
/* End fuel types */

/* Start fireplace types */
Route::get('fireplace_types', array(
    'as' => 'fireplace_types',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypes'
));

Route::get('fireplace_types/add', array(
    'as' => 'fireplace_types_add',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypesAdd'
));

Route::Put('fireplace_types/add', array(
    'as' => 'fireplace_types_add',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypesAddPost'
));

Route::get('fireplace_types/edit/{id}', array(
    'as' => 'fireplace_types_edit',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypesEdit'
));

Route::put('fireplace_types/edit', array(
    'as' => 'fireplace_types_edit',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypesEditPut'
));

Route::post('fireplace_types/delete/{id}', array(
    'as' => 'fireplace_types_delete',
    'uses' => 'Admin\FireplaceTypesController@fireplaceTypesDelete'
));
/* End fireplace types */

/* Start options */
Route::get('options/{product_id}', array(
    'as' => 'options',
    'uses' => 'Admin\OptionsAndAccessoriesController@options'
));

Route::get('options/add/{product_id}', array(
    'as' => 'options_add',
    'uses' => 'Admin\OptionsAndAccessoriesController@optionsAdd'
));

Route::Put('options/add/{product_id}', array(
    'as' => 'options_add',
    'uses' => 'Admin\OptionsAndAccessoriesController@optionsAddPost'
));

Route::get('options/edit/{id}/{product_id}', array(
    'as' => 'options_edit',
    'uses' => 'Admin\OptionsAndAccessoriesController@optionsEdit'
));

Route::put('options/edit/{product_id}', array(
    'as' => 'options_edit',
    'uses' => 'Admin\OptionsAndAccessoriesController@optionsEditPut'
));

Route::post('options/delete/{id}/', array(
    'as' => 'options_delete',
    'uses' => 'Admin\OptionsAndAccessoriesController@optionsDelete'
));
/* End options */

/* Start products */
Route::get('products', array(
    'as' => 'products',
    'uses' => 'Admin\ProductsController@products'
));

Route::get('products/add', array(
    'as' => 'products_add',
    'uses' => 'Admin\ProductsController@productsAdd'
));

Route::Put('products/add', array(
    'as' => 'products_add',
    'uses' => 'Admin\ProductsController@productsAddPost'
));

Route::get('products/edit/{id}', array(
    'as' => 'products_edit',
    'uses' => 'Admin\ProductsController@productsEdit'
));

Route::put('products/edit', array(
    'as' => 'products_edit',
    'uses' => 'Admin\ProductsController@productsEditPut'
));

Route::post('products/delete/{id}', array(
    'as' => 'products_delete',
    'uses' => 'Admin\ProductsController@productsDelete'
));
/* End products */

/* Start Product documents */
Route::get('product_documents/{product_id}', array(
    'as' => 'product_documents',
    'uses' => 'Admin\ProductDocumentsController@productDocuments'
));

Route::get('product_documents/{product_id}/add/', array(
    'as' => 'product_document_add',
    'uses' => 'Admin\ProductDocumentsController@productDocumentAdd'
));

Route::post('product_documents/add', array(
    'as' => 'product_document_add',
    'uses' => 'Admin\ProductDocumentsController@productDocumentAddPost'
));

Route::get('product_documents/{product_id}/edit/{id}', array(
    'as' => 'product_document_edit',
    'uses' => 'Admin\ProductDocumentsController@productDocumentEdit'
));

Route::put('product_documents/edit', array(
    'as' => 'product_document_edit',
    'uses' => 'Admin\ProductDocumentsController@productDocumentEditPut'
));

Route::post('product_documents/delete/{id}', array(
    'as' => 'product_document_delete',
    'uses' => 'Admin\ProductDocumentsController@productDocumentDelete'
));

/* End Product documents */

/* Start testimonials */
Route::get('testimonials', array(
    'as' => 'testimonials',
    'uses' => 'Admin\TestimonialsController@testimonials'
));

Route::get('testimonials/add', array(
    'as' => 'testimonials_add',
    'uses' => 'Admin\TestimonialsController@testimonialsAdd'
));

Route::Put('testimonials/add', array(
    'as' => 'testimonials_add',
    'uses' => 'Admin\TestimonialsController@testimonialsAddPost'
));

Route::get('testimonials/edit/{id}', array(
    'as' => 'testimonials_edit',
    'uses' => 'Admin\TestimonialsController@testimonialsEdit'
));

Route::put('testimonials/edit', array(
    'as' => 'testimonials_edit',
    'uses' => 'Admin\TestimonialsController@testimonialsEditPut'
));

Route::post('testimonials/delete/{id}', array(
    'as' => 'testimonials_delete',
    'uses' => 'Admin\TestimonialsController@testimonialsDelete'
));
/* End testimonials */

/* Start galleries */
Route::get('galleries', array(
    'as' => 'galleries',
    'uses' => 'Admin\GalleryController@galleries'
));

Route::get('galleries/add', array(
    'as' => 'galleries_add',
    'uses' => 'Admin\GalleryController@galleriesAdd'
));

Route::Put('galleries/add', array(
    'as' => 'galleries_add',
    'uses' => 'Admin\GalleryController@galleriesAddPost'
));

Route::get('galleries/edit/{id}', array(
    'as' => 'galleries_edit',
    'uses' => 'Admin\GalleryController@galleriesEdit'
));

Route::put('galleries/edit', array(
    'as' => 'galleries_edit',
    'uses' => 'Admin\GalleryController@galleriesEditPut'
));

Route::post('galleries/delete/{id}', array(
    'as' => 'galleries_delete',
    'uses' => 'Admin\GalleryController@galleriesDelete'
));
/* End galleries */


/* fireplac size ranges */
Route::get('fireplaceSizeRanges', array(
    'as' => 'fireplace_size_ranges',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRanges'
));

Route::get('fireplaceSizeRanges/add', array(
    'as' => 'fireplace_size_ranges_add',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRangesAdd'
));

Route::Put('fireplaceSizeRanges/add', array(
    'as' => 'fireplace_size_ranges_add',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRangesAddPost'
));

Route::get('fireplaceSizeRanges/edit/{id}', array(
    'as' => 'fireplace_size_ranges_edit',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRangesEdit'
));

Route::put('fireplaceSizeRanges/edit', array(
    'as' => 'fireplace_size_ranges_edit',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRangesEditPut'
));

Route::post('fireplaceSizeRanges/delete/{id}', array(
    'as' => 'fireplace_size_ranges_delete',
    'uses' => 'Admin\FireplaceSizeRangesController@fireplaceSizeRangesDelete'
));

/* End fireplac size ranges */

/* heat output ranges */
Route::get('heatOutputRanges', array(
    'as' => 'heat_output_ranges',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRanges'
));

Route::get('heatOutputRanges/add', array(
    'as' => 'heat_output_ranges_add',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRangesAdd'
));

Route::Put('heatOutputRanges/add', array(
    'as' => 'heat_output_ranges_add',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRangesAddPost'
));

Route::get('heatOutputRanges/edit/{id}', array(
    'as' => 'heat_output_ranges_edit',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRangesEdit'
));

Route::put('heatOutputRanges/edit', array(
    'as' => 'heat_output_ranges_edit',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRangesEditPut'
));

Route::post('heatOutputRanges/delete/{id}', array(
    'as' => 'heat_output_ranges_delete',
    'uses' => 'Admin\HeatOutputRangesController@heatOutputRangesDelete'
));

/* End heat output ranges */


/* price ranges */
Route::get('priceRanges', array(
    'as' => 'price_ranges',
    'uses' => 'Admin\PriceRangesController@priceRanges'
));

Route::get('priceRanges/add', array(
    'as' => 'price_ranges_add',
    'uses' => 'Admin\PriceRangesController@priceRangesAdd'
));

Route::Put('priceRanges/add', array(
    'as' => 'price_ranges_add',
    'uses' => 'Admin\PriceRangesController@priceRangesAddPost'
));

Route::get('priceRanges/edit/{id}', array(
    'as' => 'price_ranges_edit',
    'uses' => 'Admin\PriceRangesController@priceRangesEdit'
));

Route::put('priceRanges/edit', array(
    'as' => 'price_ranges_edit',
    'uses' => 'Admin\PriceRangesController@priceRangesEditPut'
));

Route::post('priceRanges/delete/{id}', array(
    'as' => 'price_ranges_delete',
    'uses' => 'Admin\PriceRangesController@priceRangesDelete'
));

/* End price ranges */


