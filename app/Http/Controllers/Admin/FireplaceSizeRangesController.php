<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\FireplaceSizeRange;

class FireplaceSizeRangesController extends Controller
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
    
    public function fireplaceSizeRanges()
     {
         $data = FireplaceSizeRange::paginate($this->paginationCount);
         return view('admin/fireplace_size_ranges/fireplace_size_ranges')
             ->with('data', $data);
     }

     public function fireplaceSizeRangesAdd()
     {
         return view('admin/fireplace_size_ranges/fireplace_size_ranges_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function fireplaceSizeRangesAddPost()
     {
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fireplaceSizeRanges/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['active'] = Request::input('active', 0);

        FireplaceSizeRange::create($input);

        return redirect('/fireplaceSizeRanges');
     }

     public function fireplaceSizeRangesEdit($id)
     {
         $data = FireplaceSizeRange::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/fireplace_size_ranges/fireplace_size_ranges_add')
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function fireplaceSizeRangesEditPut()
     {
        $data = FireplaceSizeRange::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/fireplaceSizeRanges/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

         $data->update($input);
         return redirect('/fireplaceSizeRanges');
     }

     public function fireplaceSizeRangesDelete($id)
     {
         if(Request::ajax()) {

            $data = FireplaceSizeRange::findOrFail($id);
            $data->delete();
             return 1;
         }
    }
}
