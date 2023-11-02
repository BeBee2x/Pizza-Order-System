<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //product list
    public function productList(){
        $products = Product::get();
        return response()->json($data,200);
    }

    //category list
    public function categoryList(){
        $categories = Category::select('id','name')->get();
        return response()->json($categories, 200);
    }

    //category list
    public function categoryListDetails($id){
       $data = Category::where('id',$id)->first();
       if(isset($data)){
        return response()->json($data, 200);
       }
       return response()->json(['message'=>'There is no category'], 404);
    }

    //category create
    public function createCategory(Request $request){
        $response = Category::create(['name'=>$request->name]);
        return response()->json($response, 200);
    }

    //category delete
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json(['message'=>'Delete Success'], 200);
        }
        return response()->json(['message'=>'There is no category'], 404);
    }

    //category update
    public function updateCategory(Request $request){
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            $data = $this->getCategoryUpdateData($request);
            Category::where('id',$request->id)->update($data);
            return response()->json(['message'=>'Update Success'], 200);
        }
        return response()->json(['message'=>'There is no category'], 404);
    }

    private function getCategoryUpdateData($request){
        return [
            'name' => $request->name
        ];
    }

}
