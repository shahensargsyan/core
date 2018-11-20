<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Product;
use App\FireplaceType;
use App\FuelType;
use App\FireplaceSizeRange;
use App\HeatOutputRange;
use App\PriceRange;
use App\Services\Slim;
use File;

class ProductsController extends Controller
{
    protected $paginationCount = 20;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    
    /* Start product types */
    public function products()
     {
         $data = Product::paginate($this->paginationCount);
         return view('admin/products/products')
             ->with('data', $data);
     }

     public function productsAdd()
     {
        $fuelType = FuelType::active()->orderBy('name')->get();
        $fireplaceType = FireplaceType::active()->orderBy('name')->get();
        $fireplaceSizeRange = FireplaceSizeRange::active()->orderBy('name')->get();
        $heatOutputRange = HeatOutputRange::active()->orderBy('name')->get();
        $priceRange = PriceRange::active()->orderBy('name')->get();
        
        return view('admin/products/product_add')
                ->with('fuelType', $fuelType)
                ->with('fireplaceType', $fireplaceType)
                ->with('fireplaceSizeRange', $fireplaceSizeRange)
                ->with('heatOutputRange', $heatOutputRange)
                ->with('priceRange', $priceRange)
                ->with('image_name', time() . rand(1, 100));
     }

     public function productsAddPost()
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'additional_product_features' => 'required',
            'product_code' => 'required',
            'fireplace_type_id' => 'required',
            'fuel_type_id' => 'required',
            'fireplace_size_range_id' => 'required',
            'price_range_id' => 'required',
            'heat_output_range_id' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/products/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['additional_product_features'] = Request::input('additional_product_features');
        $input['product_code'] = Request::input('product_code');
        $input['fireplace_type_id'] = Request::input('fireplace_type_id');
        $input['fuel_type_id'] = Request::input('fuel_type_id');
        $input['fireplace_size_range_id'] = Request::input('fireplace_size_range_id');
        $input['heat_output_range_id'] = Request::input('heat_output_range_id');
        $input['price_range_id'] = Request::input('price_range_id');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/products');
        }
        if(Request::input('cover_image')){
            $input['cover_image'] = Slim::saveImage('cover_image','images/product_cover_images');
        }
        Product::create($input);

        return redirect('/products');
     }

     public function productsEdit($id)
     {
        $data = Product::findOrFail($id);
        $name = explode('.', $data->image);
        $fuelType = FuelType::active()->orderBy('name')->get();
        $fireplaceType = FireplaceType::active()->orderBy('name')->get();
        $fireplaceSizeRange = FireplaceSizeRange::active()->orderBy('name')->get();
        $heatOutputRange = HeatOutputRange::active()->orderBy('name')->get();
        $priceRange = PriceRange::active()->orderBy('name')->get();
         return view('admin/products/product_add')
            ->with('fuelType', $fuelType)
            ->with('fireplaceType', $fireplaceType)
            ->with('fireplaceSizeRange', $fireplaceSizeRange)
            ->with('heatOutputRange', $heatOutputRange)
            ->with('priceRange', $priceRange)
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function productsEditPut()
     {
        $product = Product::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/products/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['additional_product_features'] = Request::input('additional_product_features');
        $input['product_code'] = Request::input('product_code');
        $input['fireplace_type_id'] = Request::input('fireplace_type_id');
        $input['fuel_type_id'] = Request::input('fuel_type_id');
        $input['fireplace_size_range_id'] = Request::input('fireplace_size_range_id');
        $input['heat_output_range_id'] = Request::input('heat_output_range_id');
        $input['price_range_id'] = Request::input('price_range_id');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/products');
        }
        if(Request::input('cover_image')){
            $input['cover_image'] = Slim::saveImage('cover_image','images/product_cover_images');
        }
        $product->update($input);
        
        return redirect('/products');
     }

     public function productsDelete($id)
     {
         if(Request::ajax()) {
             
            $data = Product::findOrFail($id);
            File::delete(base_path().'/public/images/products/' . $data->image);
            File::delete(base_path().'/public/images/product_cover_images/' . $data->cover_image);
            foreach($data->options as $value)
            {
                File::delete(base_path().'/public/images/options_and_accessory/' . $value->image);
                $value->delete();
            }
            $data->delete();
            return 1;
         }
    }
}
