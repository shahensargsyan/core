<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\FireplaceType;
use App\Services\Slim;

class FireplaceTypesController extends Controller
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
    
    /* Start fireplace types */
    public function fireplaceTypes()
     {
         $data = FireplaceType::paginate($this->paginationCount);
         return view('admin/fireplace_type/fireplace_types')
             ->with('data', $data);
     }

     public function fireplaceTypesAdd()
     {
         return view('admin/fireplace_type/fireplace_type_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function fireplaceTypesAddPost()
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fireplace_types/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/fireplace_types');
        }
        FireplaceType::create($input);

        return redirect('/fireplace_types');
     }

     public function fireplaceTypesEdit($id)
     {
         $data = FireplaceType::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/fireplace_type/fireplace_type_add')
             ->with('data', $data)
            ->with('image_name', $name[0])
             ->with('edit_id', $id);
     }

     public function fireplaceTypesEditPut()
     {
        $data = FireplaceType::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fireplace_types/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/fireplace_types');
        }
         $data->update($input);
         return redirect('/fireplace_types');
     }

     public function fireplaceTypesDelete($id)
     {
         if(Request::ajax()) {

            $data = FireplaceType::findOrFail($id);
            $data->delete();
             return 1;
         }
    }
}
