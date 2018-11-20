<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Testimonial;
use App\Services\Slim;
use File;

class TestimonialsController extends Controller
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
    public function testimonials()
     {
         $data = Testimonial::paginate($this->paginationCount);
         return view('admin/testimonials/testimonials')
             ->with('data', $data);
     }

     public function testimonialsAdd()
     {
         return view('admin/testimonials/testimonial_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function testimonialsAddPost()
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/testimonials/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/testimonials');
        }
        Testimonial::create($input);

        return redirect('/testimonials');
     }

     public function testimonialsEdit($id)
     {
         $data = Testimonial::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/testimonials/testimonial_add')
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function testimonialsEditPut()
     {
        $data = Testimonial::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/testimonials/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/testimonials');
        }
         $data->update($input);
         return redirect('/testimonials');
     }

     public function testimonialsDelete($id)
     {
         if(Request::ajax()) {

            $data = Testimonial::findOrFail($id);
            File::delete(base_path().'/public/images/testimonials/' . $data->image);
            $data->delete();
            return 1;
         }
    }
}
