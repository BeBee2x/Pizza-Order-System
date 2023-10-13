<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //home
    public function home(){
        $pizza_data = Product::orderBy('id','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza_data','categories','cart','order'));
    }

    //cart list
    public function cartList(){
        $cart_data = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                     ->leftJoin('products','products.id','carts.product_id')
                     ->where('carts.user_id',Auth::user()->id)
                     ->get();
        $total_price = 0;
        foreach($cart_data as $item){
            $total_price += $item->pizza_price * $item->qty;
        }
        return view('user.main.cart',compact('cart_data','total_price'));
    }


    //history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

    //filter
    public function filter($id){
        $pizza_data = Product::where('category_id',$id)->orderBy('id','desc')->get();
        $categories = Category::get();
        return view('user.main.home',compact('pizza_data','categories'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.account.changePassword');
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
        $cart_data =[];
        return view('user.main.cart',compact('cart_data'));
    }

    //contact page
    public function contactPage(){
        return view('user.contact.contactPage');
    }

    //send contact
    public function sendContactMessage(Request $request){
        $contactData = $this->getContactData($request);
        Contact::create($contactData);
        return view('user.contact.successPage');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $user = User::select('password')->where('id',$id)->first();
        if(Hash::check($request->oldPassword,$user->password)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',$id)->update($data);

            Auth::logout();
            return redirect()->route('auth-loginPage');
        }
        return back()->with(['oldPassword_status'=>"Your Old Password is Wrong"]);
    }

    //details page
    public function details(){
        return view('user.account.details');
    }

    //pizza details page
    public function pizzaDetails($id){
        $pizza_data = Product::where('id',$id)->first();
        return view('user.main.details',compact('pizza_data'));
    }

    //update page
    public function updatePage(){
        return view('user.account.updateAccount');
    }

    //account update
    public function update(Request $request,$id){
        $this->updateValidationCheck($request);
        $data = $this->getUserData($request);
        if($request->hasFile('image')){
            $userData = User::where('id',$id)->first();
            $db_image = $userData->image;
            if($db_image!=NULL){
                Storage::delete('public/'.$db_image);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user-details');
    }

    //get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }

    //password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required||min:6|same:newPassword'
        ])->validate();
    }

    //userdatatoArray
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    //update validation
    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

}

