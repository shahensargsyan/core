<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\OptionsAndAccessory;
use App\Services\Slim;
use File;

class OptionsAndAccessoriesController extends Controller
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
    
    /* Start options types */
    public function options($product_id)
     {
         $data = OptionsAndAccessory::where('product_id', $product_id)->paginate($this->paginationCount);
         return view('admin/options/options')
             ->with('product_id', $product_id)
             ->with('data', $data);
     }

     public function optionsAdd($product_id)
     {
         return view('admin/options/options_add')
                ->with('product_id', $product_id)
                ->with('image_name', time() . rand(1, 100));
     }

     public function optionsAddPost($product_id)
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/options/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['product_id'] = $product_id;
        $input['active'] = Request::input('active', 0);
        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/options_and_accessory');
        }
        OptionsAndAccessory::create($input);

        return redirect('/options/'.$product_id);
     }

     public function optionsEdit($id,$product_id)
     {
         $data = OptionsAndAccessory::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/options/options_add')
                ->with('data', $data)
                ->with('product_id', $product_id)
                ->with('image_name', $name[0])
                ->with('edit_id', $id);
     }

     public function optionsEditPut($product_id)
     {
        $data = OptionsAndAccessory::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/options/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/options_and_accessory');
        }
         $data->update($input);
         return redirect('/options/'.$product_id);
     }

     public function optionsDelete($id)
     {
         if(Request::ajax()) {

            $data = OptionsAndAccessory::findOrFail($id);
            File::delete(base_path().'/public/images/options_and_accessory/' . $data->image);
            $data->delete();
             return 1;
         }
    }
}
