<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
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

    //account info
    public function accountInfo(){
        return view('admin.account.details');
    }

    //account edit
    public function accountInfoEditPage(){
        return view('admin.account.edit');
    }

    //account update
    public function accountInfoUpdate(Request $request,$id){
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
        return redirect()->route('admin-accountInfo');
    }

    //admin list
    public function list(){
        $admin = User::when(request('searchKey'),function($query){
            $query->orWhere('name','like','%'.request('searchKey').'%')
                  ->orWhere('email','like','%'.request('searchKey').'%')
                  ->orWhere('phone','like','%'.request('searchKey').'%')
                  ->orWhere('address','like','%'.request('searchKey').'%');
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin list delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete_status'=>'Admin removed!']);
    }

    //user list delete
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with(['delete_status'=>'User removed!']);
    }

    //change role page
    public function changeRolePage($id){
        $data = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('data'));
    }

    //change role
    public function changeRole(Request $request,$id){
        $data = $this->getRoleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin-list');
    }

    //user list
    public function userList(){
        $user = User::where('role','user')->paginate(5);
        return view('admin.user.list',compact('user'));
    }

    //change admin page
    public function changeAdminPage($id){
        $data = User::where('id',$id)->first();
        return view('admin.user.changeRole',compact('data'));
    }

    //chage admin
    public function changeAdmin(Request $request,$id){
        $data = $this->getRoleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin-userList');
    }

    //edit user page
    public function editUserPage($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.editPage',compact('user'));
    }

    //user message page
    public function userMessagePage(){
        $messages = Contact::get();
        return view('admin.messages.userMessagePage',compact('messages'));
    }

    //role data
    private function getRoleData($request){
        return [
            'role' => $request->role
        ];
    }

    //password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
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
