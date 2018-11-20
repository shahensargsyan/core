<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\FuelType;
use App\Services\Slim;
use File;

class FuelTypesController extends Controller
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
    
    /* Start fuel types */
    public function fuelTypes()
     {
         $data = FuelType::paginate($this->paginationCount);
         return view('admin/fuel_type/fuel_types')
             ->with('data', $data);
     }

     public function fuelTypesAdd()
     {
         return view('admin/fuel_type/fuel_type_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function fuelTypesAddPost()
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fuel_types/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/fuel_types');
        }
        FuelType::create($input);

        return redirect('/fuel_types');
     }

     public function fuelTypesEdit($id)
     {
         $data = FuelType::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/fuel_type/fuel_type_add')
             ->with('data', $data)
            ->with('image_name', $name[0])
             ->with('edit_id', $id);
     }

     public function fuelTypesEditPut()
     {
        $data = FuelType::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fuel_types/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/fuel_types');
        }
         $data->update($input);
         return redirect('/fuel_types');
     }

     public function fuelTypesDelete($id)
     {
         if(Request::ajax()) {

            $data = FuelType::findOrFail($id);
            File::delete(base_path().'/public/images/fuel_types/' . $data->image);
            $data->delete();
            return 1;
         }
    }
}
