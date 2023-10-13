<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list page
    public function list(){
        $categories = Category::when(request('searchKey'),function($query){
             $query->where('name','like','%'.request('searchKey').'%');
            })
        ->orderBy('id','desc')
        ->paginate(4);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //create page
    public function createPage(){
        return view('admin.category.createpage');
    }

    //creation
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryDataToArray($request);
        Category::create($data);
        return redirect()->route('category-list')->with(['creation_status'=>'Creation Success']);
    }

    //delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['delete_status'=>'Delete Success']);
    }

    //edit
    public function edit($id){

        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryDataToArray($request);
        Category::where('id',$request->id)->update($data);
        return redirect()->route('category-list')->with(['update_status'=>'Update Success!']);
    }

    //validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->id
        ])->validate();
    }

    //Change to array
    private function categoryDataToArray($request){
        return [
            'name' => $request->categoryName
        ];
    }

}
