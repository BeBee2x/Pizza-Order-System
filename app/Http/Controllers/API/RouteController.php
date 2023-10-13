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
}
