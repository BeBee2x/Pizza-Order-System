<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //pizza list
    public function pizzalist(Request $request){
        $data = Product::orderBy('created_at',$request->status)->get();
        return $data;
    }

    //add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Add To Cart Success'
        ];
        return response()->json($response,200);
    }

    //order
    public function order(Request $request){
        $total_price=0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total_price += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id ,
            'order_code' => $data->order_code ,
            'total_price' => $total_price+3000 ,
        ]);

        return response()->json([
            'status' => 'true'
        ],200);
    }

    //view count
    public function viewCount(Request $request){
        $product = Product::where('id',$request->product_id)->first();
        $product = $product->view_count;
        Product::where('id',$request->product_id)->update(['view_count' => $product+1]);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId ,
            'product_id' => $request->pizzaId ,
            'qty' => $request->quantity
        ];
    }
}
