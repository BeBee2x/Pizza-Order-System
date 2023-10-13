<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //list
    public function list(){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->get();
        return view('admin.order.list',compact('order'));
    }

    //search by status
    public function searchByStatus(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id');
        if($request->status == null){
            $order = $order->get();
        }else{
            $order = $order->where('status',$request->status)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    //order details
    public function details($orderCode){
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code',$orderCode)
        ->get();
        $total_price = 0;
        foreach($orderList as $item){
            $total_price += $item->total;
        }
        return view('admin.order.details',compact('orderList','total_price'));
    }

    //change status
    public function statusChange(Request $request){
        $data = [ 'status' => $request->status ];
        Order::where('id',$request->id)->update($data);
    }
}
