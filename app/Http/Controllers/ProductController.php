<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizza_data = Product::select('products.*','categories.name as category_name')
        ->when(request('searchKey'),function($query){
            $query->where('products.name','like','%'.request('searchKey').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.id','desc')->paginate(4);
        $pizza_data->appends(request()->all());
        return view('admin.products.pizzalist',compact('pizza_data'));
    }

    //createPage
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.products.createPizza',compact('categories'));
    }

    //create
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->createPizzaData($request);
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product-list')->with(['create_status'=>'Creation Completed!']);
    }

    //delete
    public function delete($id){
        $data = Product::where('id',$id)->first();
        Storage::delete('public/'.$data->image);
        Product::where('id',$id)->delete();
        return back()->with(['delete_status'=>'Delete Completed!']);
    }

    //details page
    public function details($id){
        $pizza_data = Product::where('id',$id)->first();
        return view('admin.products.details',compact('pizza_data'));
    }

    //edit page
    public function editPage($id){
        $pizza_data = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.products.edit',compact('pizza_data','categories'));
    }

    //update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->createPizzaData($request);
        if($request->hasFile('pizzaImage')){
            $oldImage = Product::where('id',$request->pizzaId)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/'.$oldImage);
            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product-list');
    }

    //product create validation
    private function productValidationCheck($request,$status){
        $validationRules = [
            'pizzaCategory' => 'required',
            'pizzaName' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaPrice' => 'required',
            'description' => 'required',
            'pizzaWaitingTime' => 'required'
        ];

        $validationRules['pizzaImage'] = $status == "create" ? 'required|mimes:jpg,png,jpeg,webp|file' : "mimes:jpg,png,jpeg,webp|file";

        Validator::make($request->all(),$validationRules)->validate();
    }

    //product data change to array
    private function createPizzaData($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'price' => $request->pizzaPrice,
            'description' => $request->description,
            'waiting_time' => $request->pizzaWaitingTime
        ];
    }
}
