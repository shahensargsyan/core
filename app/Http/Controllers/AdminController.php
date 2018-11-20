<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use App\Slider;
use App\CustomInformation;
use App\Service;
use App\ServiceType;
use File;
use Image;
use App\Services\Slim;
use App\Services\SlimStatus;
use DB;


class AdminController extends Controller
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
        $this->middleware('is_admin', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin');
    }
    
    
    
    /* Start services */
    public function services()
    {

        $data = Service::paginate($this->paginationCount);
        return view('admin.services')
            ->with('data', $data);
    }

    public function servicesAdd()
    {
        
        return view('admin.service_add')
                ->with('name', time() . rand(1, 100));
    }

    public function servicesAddPost()
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/services/add')
                ->withErrors($validator)->withInput();
        }
        
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);

        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/services');
        }
        Service::create($input);
        $service = '/';

        return redirect('services');
    }
    
    public function servicesEdit($id)
    {
        $service = Service::find($id);
        $name = explode('.', $service->image);
        if(!$service)
            return redirect('/services'); 
        return view('admin.service_add')
            ->with('service', $service)
            ->with('name', $name[0])
            ->with('edit_id', $id);
    }
    
    public function servicesEditPut()
    {
        $service = Service::find(Request::input('id'));
        if(!$service)
            return redirect('/services'); 
        $rules = array(
            'name' => 'required',
            'description' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/services/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }
        $input['name'] = Request::input('name');
        $input['description'] = Request::input('description');
        $input['active'] = Request::input('active', 0);
        if(Request::has('service_type_id')){
             $input['service_type_id'] = Request::input('service_type_id');
        }
        if(Request::input('image')){
             $input['image'] = Slim::saveImage('image','images/services');
        }
        
        $service->update($input);
        return redirect('/services');
    }
    
    public function servicesDelete($id)
    {
        if(Request::ajax()) {
            $service = Service::find($id);
            File::delete(base_path().'/public/images/services/' . $service->image);
            if(!$service)
                return 0;
            
            $service->delete();
            return 1;
        }
    }
    /* End service */
    
    
    /* Start Slider */
    public function slider()
    {
        $data = DB::table('sliders')->paginate();
        return view('admin.sliders')
            ->with('data', $data);
    }

    public function sliderAdd()
    {
        return view('admin.sliders_add')
            ->with('image_name', time() . rand(1, 100));
    }

    public function sliderAddPost()
    {
        $rules = array(
            'image' => 'required',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/sliders/add')
                ->withErrors($validator)->withInput();
        }

         $slider = [];
         $slider['active'] = Request::input('active', 0);
         $slider['description'] = Request::input('description');
         $slider['name'] = Request::input('name');
        
        if(Request::input('image')){
             $slider['image'] = Slim::saveImage('image','images/sliders');
        }
		
        Slider::create($slider);
        
        return redirect('/sliders');
    }
	
    public function sliderEdit($id)
    {
        $slider = Slider::find($id);
        $name = explode('.', $slider->image);
        if(!$slider)
            return redirect('/sliders'); 
        return view('admin.sliders_add')
            ->with('image_name', $name[0])
            ->with('slider', $slider)
            ->with('edit_id', $id);
    }
    
    public function sliderEditPut()
    {
        
        $Slider = Slider::find(Request::input('id'));
        if(!$Slider)
            return redirect('/sliders');
        $slider = [];
        $slider['description'] = Request::input('description');
        $slider['name'] = Request::input('name');
        $slider['active'] = Request::input('active', 0);
        
        if(Request::input('image')){
             $slider['image'] = Slim::saveImage('image','images/sliders');
        }

        $Slider->update($slider);
		
        return redirect('/sliders');
    }
    
    public function sliderDelete($id)
    {
        if(Request::ajax()) {
            
            $slider = Slider::find($id);
            
            if(!$slider)
                return 0;
            
            File::delete(base_path().'/public/images/sliders/' . $slider->image);
            
            $slider->delete();
            
            return 1;
        }
    }
     /* End Slider */
    
    
    /* Custom Information */
    
    public function restInformation()
    {
        $custom_information = CustomInformation::first();
        return view('admin.custom_information')
            ->with('custom_information', $custom_information);
    }
    
    public function restInformationEdit($id)
    {
        $custom_information = CustomInformation::find($id);
        if(!$custom_information)
            return redirect('/custom_information');
        return view('admin.custom_information_add')
            ->with('custom_information', $custom_information)
            ->with('edit_id', $id);
    }
    
    public function restInformationEditPut()
    {
        if(!Request::input('id'))
            return redirect('/custom_information');
        
        $rules = array(
            'address' => 'required',
        );
        
        $validator = Validator::make(Request::all(), $rules);
        
        if ($validator->fails()) {
            return redirect('/custom_information/edit/' . Request::input('id'))
                ->withErrors($validator)->withInput();
        }
        $custom_information = CustomInformation::find(Request::input('id'));
        if(!$custom_information)
            return redirect('/custom_information');
        
        $input = Request::all();       
        $custom_information->update($input);
        
        return redirect('/custom_information');
    }
    
    public function uploadSlimAvatar(){
            $images = array();
            try {
                    if(!empty(Slim::getImages('image'))){
                        $images = Slim::getImages('image');
                    }
                    if(!empty(Slim::getImages('cover_image'))){
                        $images = Slim::getImages('cover_image');
                    }

            }
            catch (Exception $e) {

                    Slim::outputJSON(array(
                            'status' => SlimStatus::FAILURE,
                            'message' => 'Unknown'
                    ));

                    return;
            }

            if ($images === false) {
                    Slim::outputJSON(array(
                            'status' => SlimStatus::FAILURE,
                            'message' => 'No data posted'
                    ));

                    return;
            }

            $image = array_shift($images);

            if (!isset($image)) {

                    Slim::outputJSON(array(
                            'status' => SlimStatus::FAILURE,
                            'message' => 'No images found'
                    ));

                    return;
            }
            if (!isset($image['output']['data']) && !isset($image['input']['data'])) {
                    Slim::outputJSON(array(
                            'status' => SlimStatus::FAILURE,
                            'message' => 'No image data'
                    ));

                    return;
            }
            if (isset($image['output']['data'])) {
                    $name = $image['output']['name'];

                    $data = $image['output']['data'];
                    $output = Slim::saveFile($data, $name,base_path().'/public/images/temp/');
            }

            if (isset($image['input']['data'])) {
                    $name = $image['input']['name'];
                    $data = $image['input']['data'];
                    $input = Slim::saveFile($data, $name,base_path().'/public/images/temp/');
            }

            $response = array(
                    'status' => SlimStatus::SUCCESS
            );

            if (isset($output) && isset($input)) {

                    $response['output'] = array(
                            'file' => $output['name'],
                            'path' => $output['path']
                    );

                    $response['input'] = array(
                            'file' => $input['name'],
                            'path' => $input['path']
                    );

            }
            else {
                    $response['file'] = isset($output) ? $output['name'] : $input['name'];
                    $response['path'] = isset($output) ? $output['path'] : $input['path'];
            }

            // Return results as JSON String
            Slim::outputJSON($response);exit();

    }
}
