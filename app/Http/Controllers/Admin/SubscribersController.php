<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Request;
use Validator;
use App\Subscriber;
use Excel;

class SubscribersController extends Controller
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
    }

    
    /* Start Subscribers*/
    public function index()
    {
        $data = Subscriber::paginate($this->paginationCount);
        return view('admin.subscribers')
            ->with('data', $data);
    }
	
    public function subscribersExportCsv()
    {
        $data = Subscriber::all(['email'])->toArray();
        return Excel::create('subscribers', function($excel) use ($data) {
			
			$excel->sheet('sheet', function($sheet) use ($data){
			
				$sheet->fromArray($data);
			});
			
		})->export('csv');
    }
    
    public function subscribersDelete($id)
    {
        if(Request::ajax()) {
            
            $subscriber = Subscriber::find($id);
            
            if(!$subscriber)
                return 0;

            $subscriber->delete();
            
            return 1;
        }
    }
    
    /* End Subscribers*/
    
    
    
}
