<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Gallery;
use App\Services\Slim;
use File;

class GalleryController extends Controller
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
    
    /* Start Gallery */
    public function galleries()
     {
         $data = Gallery::paginate($this->paginationCount);
         return view('admin/galleries/galleries')
             ->with('data', $data);
     }

     public function galleriesAdd()
     {
         return view('admin/galleries/gallery_add')
                ->with('image_name', time() . rand(1, 100));
     }

     public function galleriesAddPost()
     {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/galleries/add')
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/galleries');
        }
        Gallery::create($input);

        return redirect('/galleries');
     }

     public function galleriesEdit($id)
     {
         $data = Gallery::findOrFail($id);
         $name = explode('.', $data->image);
         return view('admin/galleries/gallery_add')
            ->with('data', $data)
            ->with('image_name', $name[0])
            ->with('edit_id', $id);
     }

     public function galleriesEditPut()
     {
        $data = Gallery::findOrFail(Request::input('id'));

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/galleries/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }

        $input = [];
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
            $input['image'] = Slim::saveImage('image','images/galleries');
        }
         $data->update($input);
         return redirect('/galleries');
     }

     public function galleriesDelete($id)
     {
         if(Request::ajax()) {

            $data = Gallery::findOrFail($id);
            File::delete(base_path().'/public/images/galleries/' . $data->image);
            $data->delete();
            return 1;
         }
    }
}
