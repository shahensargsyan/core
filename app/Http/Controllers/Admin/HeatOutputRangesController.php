<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\HeatOutputRange;
use App\Services\Slim;

class HeatOutputRangesController extends Controller
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
    
    /* Start testimonial */
    public function heatOutputRanges()
     {
         $data = HeatOutputRange::paginate($this->paginationCount);
         return view('admin/heat_output_ranges/heat_output_ranges')
             ->with('data', $data);
     }

     public function heatOutputRangesAdd()
     {
         return view('admin/heat_output_ranges/heat_output_ranges_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function heatOutputRangesAddPost()
     {
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/heatOutputRanges/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['active'] = Request::input('active', 0);

        HeatOutputRange::create($input);

        return redirect('/heatOutputRanges');
     }

     public function heatOutputRangesEdit($id)
     {
         $data = HeatOutputRange::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/heat_output_ranges/heat_output_ranges_add')
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function heatOutputRangesEditPut()
     {
        $data = HeatOutputRange::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/heatOutputRanges/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['active'] = Request::input('active', 0);

        $data->update($input);
        return redirect('/heatOutputRanges');
     }

     public function heatOutputRangesDelete($id)
     {
         if(Request::ajax()) {

            $data = HeatOutputRange::findOrFail($id);
            $data->delete();
             return 1;
         }
    }
}
