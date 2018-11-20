<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\PriceRange;

class PriceRangesController extends Controller
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
    public function priceRanges()
     {
         $data = PriceRange::paginate($this->paginationCount);
         return view('admin/price_ranges/price_ranges')
             ->with('data', $data);
     }

     public function priceRangesAdd()
     {
         return view('admin/price_ranges/price_ranges_add');
     }

     public function priceRangesAddPost()
     {
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/priceRanges/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['active'] = Request::input('active', 0);

        PriceRange::create($input);

        return redirect('/priceRanges');
     }

     public function priceRangesEdit($id)
     {
         $data = PriceRange::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/price_ranges/price_ranges_add')
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function priceRangesEditPut()
     {
        $data = PriceRange::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/priceRanges/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['active'] = Request::input('active', 0);

        $data->update($input);
        return redirect('/priceRanges');
     }

     public function priceRangesDelete($id)
     {
         if(Request::ajax()) {

            $data = PriceRange::findOrFail($id);
            $data->delete();
             return 1;
         }
    }
}
