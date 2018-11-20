<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Subscriber;
use App\Slider;
use App\Gallery;
use App\CustomInformation;
use App\OptionsAndAccessory;
use App\FuelType;
use App\FireplaceType;
use App\FireplaceSizeRange;
use App\HeatOutputRange;
use App\PriceRange;
use App\Testimonial;
use App\Product;
use App\Service;
use Mail;
use Log;

class ApiController extends Controller
{   

    public function __construct()
    {
        
    }
    
    public function test()
    {       
        return 'message sent!';
    }

    public function getAllData()
    {
        $data = [];
        
        $data['slider'] = $this->getSliderImages(1);
        $data['gallery'] = $this->getGalleryImages(1);
        $data['services'] = $this->getServices(1);
        $data['custom_data'] = $this->getCustomData(1);
        $data['products'] = $this->getProducts(1);
        $data['fireplaceOptionsAndAccessories'] = $this->getFireplaceOptionsAndAccessories(1);
        $data['fuelTypes'] = $this->getFuelTypes(1);
        $data['fireplaceTypes'] = $this->getFireplaceTypes(1);
        $data['testimonials'] = $this->getTestimonials(1);
        $data['fireplaceSizeRanges'] = $this->getFireplaceSizeRanges(1);
        $data['heatOutputRanges'] = $this->getHeatOutputRanges(1);
        $data['priceRanges'] = $this->getPriceRanges(1);
        
        return response()->json($data);
    }
    
    public function getCustomData($all = 0)
    {
        $data = [];
        
        $custom_information = CustomInformation::first();
        
        $data['phone'] = $custom_information->phone;
        $data['email'] = $custom_information->email;
        $data['address'] = $custom_information->address;
        $data['copyright'] = nl2br($custom_information->copyright);
        $data['facebook_link'] = $custom_information->facebook_link;
        $data['twitter_link'] = $custom_information->twitter_link;
        $data['instagram_link'] = $custom_information->instagram_link;
        $data['google_plus_link'] = $custom_information->google_plus_link;
        $data['about_text'] = $custom_information->about_text;
        $data['yelp'] = $custom_information->yelp;
        $data['meta_title'] = $custom_information->meta_title;
        $data['meta_keywords'] = $custom_information->meta_keywords;
        $data['meta_description'] = $custom_information->meta_description;
        
        return $all ? $data : response()->json($data);
    }
    
    public function getProducts($all = 0)
    {
        $data = [];
        
        $products = Product::active()->get();
        
        foreach($products as $product)
        {
                $options = array();
                foreach ($product->options as $option) {
                    $options[] = [
                        'name' => $option->name,
                        'description' => $option->description,
                        'image' => $option->image . '?' . time(),
                        'active' => $option->active
                    ];
                }
                $data = $this->getProductsFromObject($products);
             
        }
        return $all ? $data : response()->json($data);
    }
    
    public function filterProducts()
    {

        $products = Product::whereRaw('1 = 1');
        if(Request::input('fuel_type_id') && is_array(json_decode(Request::input('fuel_type_id')))){
            $fuel_type_id = json_decode(Request::input('fuel_type_id'));
            $products = $products->whereIn('fuel_type_id', $fuel_type_id);
        }
        if(Request::input('fireplace_type_id') && is_array(json_decode(Request::input('fireplace_type_id')))){
            $fireplace_type_id = json_decode(Request::input('fireplace_type_id'));
            $products = $products->whereIn('fireplace_type_id', $fireplace_type_id);
        }
        if(Request::input('fireplace_size_range_id') && is_array(json_decode(Request::input('fireplace_size_range_id')))){
            $fireplace_size_range_id = json_decode(Request::input('fireplace_size_range_id'));
            $products = $products->whereIn('fireplace_size_range_id', $fireplace_size_range_id);
        }
        if(Request::input('heat_output_range_id') && is_array(json_decode(Request::input('heat_output_range_id')))){
            $heat_output_range_id = json_decode(Request::input('heat_output_range_id'));
            $products = $products->whereIn('heat_output_range_id', $heat_output_range_id);
        }
        if(Request::input('price_range_id') && is_array(json_decode(Request::input('price_range_id')))){
            $price_range_id = json_decode(Request::input('price_range_id'));
            $products = $products->whereIn('price_range_id', $price_range_id);
        }
        
        $products = $products->active()->get();       
        $data = [];
        $data['success'] = true;
        $product_data = $this->getProductsFromObject($products);
        
        $data['data'] = $product_data;
        return response()->json($data);
    }


    public function getServices($all = 0)
    {
        $data = [];
        
        $services = Service::active()->get();
        foreach($services as $service)
        {
                $data[] = [
                            'id' => $service->id,
                            'name' => $service->name ? $service->name : '',
                            'description' => $service->description ? $service->description : '',
                            'image' => $service->image ? $service->image. '?' . time() : '',
                        ];
        }

        return $all ? $data : response()->json($data);
    }

    public function getSliderImages($all = 0)
    {
        $data = [];
        
        $sliders = Slider::active()->get();
        foreach($sliders as $slider)
        {
                $data[] = [
                                'id' => $slider->id ? $slider->id : '',
                                'name' => $slider->name ? $slider->name : '',
                                'description' => $slider->description ? $slider->description : '',
                                'image' => $slider->image ? $slider->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    public function getGalleryImages($all = 0)
    {
        $data = [];
        
        $images = Gallery::active()->get();
        foreach($images as $image)
        {
                $data[] = [
                                'id' => $image->id ? $image->id : '',
                                'name' => $image->name ? $image->name : '',
                                'description' => $image->description ? $image->description : '',
                                'image' => $image->image ? $image->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }

    public function getFireplaceOptionsAndAccessories($all = 0)
    {
        $data = [];
        
        $options = OptionsAndAccessory::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : '',
                                'description' => $value->description ? $value->description : '',
                                'image' => $value->image ? $value->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }

    public function getFuelTypes($all = 0)
    {
        $data = [];
        
        $options = FuelType::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : '',
                                'description' => $value->description ? $value->description : '',
                                'image' => $value->image ? $value->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getFireplaceTypes($all = 0)
    {
        $data = [];
        
        $options = FireplaceType::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : '',
                                'description' => $value->description ? $value->description : '',
                                'image' => $value->image ? $value->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getFireplaceSizeRanges($all = 0)
    {
        $data = [];
        
        $options = FireplaceSizeRange::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : ''
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getHeatOutputRanges($all = 0)
    {
        $data = [];
        
        $options = HeatOutputRange::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : ''
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getPriceRanges($all = 0)
    {
        $data = [];
        
        $options = PriceRange::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : ''
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getTestimonials($all = 0)
    {
        $data = [];
        
        $options = Testimonial::active()->get();
        foreach($options as $value)
        {
                $data[] = [
                                'id' => $value->id ? $value->id : '',
                                'name' => $value->name ? $value->name : '',
                                'description' => $value->description ? $value->description : '',
                                'image' => $value->image ? $value->image . '?' . time() : '',
                            ];
        }

        return $all ? $data : response()->json($data);
    }
    
    public function getRelatedProducts($product){
            $relatedProducts = [];
            $products = Product::active()->
                    where('id', '!=', $product->id)
                    ->where(function ($query) use ($product) {
                        $query->orWhere([
                            'id'=>$product->id,
                            'fuel_type_id'=>$product->fuelType->id,
                            'fireplace_type_id'=>$product->fireplaceType->id,
                            'fireplace_size_range_id'=>$product->fireplaceSizeRange->id,
                            'heat_output_range_id'=>$product->heatOutputRange->id,
                            'price_range_id'=>$product->priceRange->id
                        ]);
                    })->
                    limit(30)->
                    get();
            if($products){
                $relatedProducts = $this->getProductsFromObject($products);
            }
            return $relatedProducts;
    }
    
    public function getProductsFromObject($products){
        $products_array = [];
        foreach ($products as $product) {
            $options = [];
            foreach ($product->options as $option) {
                $options[] = [
                    'name' => $option->name,
                    'description' => $option->description,
                    'image' => $option->image . '?' . time(),
                    'active' => $option->active
                ];
            }
            $documents = [];
            foreach ($product->documents as $document) {
                $documents[] = [
                    'name' => $document->name,
                    'file' => $document->file,
                    'active' => $document->active
                ];
            }
            
            $products_array[] = [
                            'id' => $product->id,
                            'name' => $product->name ? $product->name : '',
                            'description' => $product->description ? $product->description : '',
                            'image' => $product->image ? $product->image . '?' . time() : '',
                            'cover_image' => $product->cover_image ? $product->cover_image . '?' . time() : '',
                            'additional_product_features' => $product->additional_product_features ? $product->additional_product_features : '',
                            'product_code' => $product->product_code ? $product->product_code : '',
                            'heat_output' => [
                                'name' => $product->heatOutputRange ? $product->heatOutputRange->name : '',
                                'id' => $product->heatOutputRange ? $product->heatOutputRange->id : '',
                            ],
                            'price' => [
                                'name' => $product->priceRange ? $product->priceRange->name : '',
                                'id' => $product->priceRange ? $product->priceRange->id : '',
                            ],
                            'fireplace_size' => [
                                'name' => $product->fireplaceSizeRange ? $product->fireplaceSizeRange->name : '',
                                'id' => $product->fireplaceSizeRange ? $product->fireplaceSizeRange->id: ''
                            ],
                            'fuelType' => [
                                'name' => $product->fuelType ? $product->fuelType->name : '',
                                'id' => $product->fuelType ? $product->fuelType->id: ''
                            ],
                            'fireplaceType' => [
                                'name' => $product->fireplaceType ? $product->fireplaceType->name : '',
                                'id' => $product->fireplaceType ? $product->fireplaceType->id: ''
                            ],
                            'options' => $options,
                            'documents' => $documents
                        ];
        }
        
        return $products_array;
    }


    public function getProductDetails(){
        
        $response = [];
        $response['success'] = FALSE;
        
        if(Request::has('product_id'))
        {
            $product = Product::find(Request::input('product_id'));
            if($product){
                $relatedProducts = $this->getRelatedProducts($product);
                $options = array();
                foreach ($product->options as $option) {
                    $options[] = [
                        'name' => $option->name,
                        'description' => $option->description,
                        'image' => $option->image . '?' . time(),
                        'active' => $option->active
                    ];
                }
                $documents = [];
                foreach ($product->documents as $document) {
                    $documents[] = [
                        'name' => $document->name,
                        'file' => $document->file,
                        'active' => $document->active
                    ];
                }
                $productDetails[] = [
                                'id' => $product->id,
                                'name' => $product->name ? $product->name : '',
                                'description' => $product->description ? $product->description : '',
                                'image' => $product->image ? $product->image . '?' . time() : '',
                                'cover_image' => $product->cover_image ? $product->cover_image . '?' . time() : '',
                                'additional_product_features' => $product->additional_product_features ? $product->additional_product_features : '',
                                'product_code' => $product->product_code ? $product->product_code : '',
                                'heat_output' => $product->heatOutputRange ? $product->heatOutputRange->name : '',
                                'price' => $product->priceRange ? $product->priceRange->name : '',
                                'fireplace_size' => $product->fireplaceSizeRange ? $product->fireplaceSizeRange->name : '',
                                'fuelType' => $product->fuelType ? $product->fuelType->name : '',
                                'fireplaceType' => $product->fireplaceType ? $product->fireplaceType->name : '',
                                'options' => $options,
                                'relatedProducts' => $relatedProducts,
                                'documents' => $documents
                            ];

                if($product->fireplaceTypes){
                    $productFireplaceTypes = [];
                    foreach ($product->fireplaceTypes as $type){
                        $productFireplaceTypes[$type->id] = $type->name;
                    }
                    $productDetails['fireplace_types'] = $productFireplaceTypes;
                }
                if($product->fuelTypes){
                    $productFuelTypes = [];
                    foreach ($product->fuelTypes as $type){
                        $productFuelTypes[$type->id] = $type->name;
                    }
                    $productDetails['fuel_types'] = $productFuelTypes;
                }
                $response['success'] = true;
                $response['productDetails'] = $productDetails;
            }else{
                $response['error'] = true;
                $response['message'] = "Can't find product";
            }
        }
        return response()->json($response);
    }


    public function addSubscriber()
    {
        
        
        if(!Request::input('contact_email_subscribe'))
			return response()->json([
                                        'error' => true,
                                        'message' => '',
                                    ]);

        $rules = array(
            'contact_email_subscribe' => 'required|email',
        );
        $validator = Validator::make(Request::all(), $rules);
        
        if ($validator->fails()) {
			$json['error'] = true;
            return response()->json($json);
        }
		
		if(!Subscriber::where('email', Request::input('contact_email_subscribe'))->first())
		{
			Subscriber::create(['email' => Request::input('contact_email_subscribe')]);
		}

		$json['success'] = true;
		return response()->json($json);
    }
    
    public function sendEmail()
    {
        if(!Request::input('contact_name') 
                || !Request::input('contact_zip_code')
                || !Request::input('contact_email')
                || !Request::input('contact_phone')
                || !Request::input('contact_message'))

			return response()->json([
                                        'error' => true,
                                        'message' => 'Something wrong with input data',
                                    ]);

        $rules = array(
            'contact_name' => 'required',
            'contact_zip_code' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'contact_message' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                                        'error' => true,
                                        'message' => 'Something wrong with input data',
                                    ]);
        }
		
        $to = CustomInformation::first()->email;
        $name = 'Name: ' . Request::input('contact_name');
        $zip_code = 'Zip Code: ' . Request::input('contact_zip_code');
        $phone = 'Phone: ' . Request::input('contact_phone');
        $message = Request::input('contact_message');
        $from = 'From: ' . Request::input('contact_email');
        $from_address = env('MAIL_FROM_ADDRESS');
        $subject = 'New Message';
        
        Mail::raw($name . "\n" . $from . "\n" . $phone . "\n" . $zip_code . "\n" . $message, function($message) use($subject, $to, $from_address)
        {
            $message->from($from_address, 'CoreFireplace');
            $message->to($to)->subject($subject);
        });

		$json['success'] = true;
		return response()->json($json);
    }

}
