<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Product;
use App\ProductDocument;
use App\User;
use File;
use Misc;

class ProductDocumentsController extends Controller
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
    
    public function productDocuments($product_id)
    {
        $data = ProductDocument::where('product_id', $product_id)->paginate($this->paginationCount);
        
        return view('admin/product_documents/product_documents')
            ->with('product_id', $product_id)
            ->with('data', $data);
    }
    
    public function productDocumentAdd($product_id)
    {
        return view('admin/product_documents/product_document_add')
                ->with('product_id', $product_id);
    }
    
    public function productDocumentAddPost()
    {
        $rules = array(
            'product_id' => 'required',
            'name' => 'required',
            'file' => 'required|file|mimes:pdf|max:5120',
        );
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return redirect('/product_documents/' . Request::input('product_id') . '/add')
                ->withErrors($validator)->withInput();
        }
        
        $input['product_id'] = Request::input('product_id');
        if(Request::has('name')){
            $input['name'] = Request::input('name');
        }
        if(Request::file('file')){
            $pdf = Request::file('file');
            $extension = $pdf->getClientOriginalExtension();
            $name = time() . rand(1,100)  . '.' . $extension;
            $input['file'] = '/documents/product_documents/' . $name;
            $result = $pdf->move(public_path() . '/documents/product_documents/', $name);
        }

        $product_document = ProductDocument::create($input);
        return redirect('/product_documents/' . Request::input('product_id'));
    }
    
    public function productDocumentDelete($id)
    {
        if(Request::ajax()) {
            
            $product_document = ProductDocument::findOrFail($id);          
            File::delete(base_path().'/public/documents/product_documents/' . $product_document->file);
            $product_document->delete();
            return 1;
        }
    }
}
