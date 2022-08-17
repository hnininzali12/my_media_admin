<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category direct page
     public function index() {
           if(Session::has('CATEGORY_SEARCH')){
            Session::forget('CATEGORY_SEARCH');
        }
           $category=Category::get();
        if(count($category)==0){
            $emptyStatus = 0;
        }
        else{
            $emptyStatus =1;
        };
        return view('admin.category.index',compact('category','emptyStatus'));
    }

    //create category
    public function categoryCreate(Request $request){
        $validation=$this->categoryValidationCheck($request);
        if($validation->fails()){
            return back()
                        ->withErrors($validation)
                        ->withInput();
        }
      $category = $this->getCategoryData($request);
      Category::create($category);
      return back()->with(['createSuccess'=>'Category Created!']);
    }

    //delete category
    public function categoryDelete($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess'=>'Category deleted!']);
    }

    //search category
    public function categorySearch(Request $request){
        $searchKey =$request->categorySearch;
        $category = Category::orwhere('title','LIKE','%'.$searchKey.'%')
                              ->orwhere('description','LIKE','%'.$searchKey.'%')
                              ->get();
          Session::put('CATEGORY_SEARCH',$searchKey);
          if(count($category) == 0){
            $emptyStatus =0;
          }else{
            $emptyStatus =1;
          };
         return view('admin.category.index',compact('category','emptyStatus'));
    }

    //edit category page
    public function categoryEdit($id){
        $category =Category::get();
        $editData =Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('category','editData'));
    }

    //update category
    public function categoryUpdate($id,Request $request){
          $validation=$this->categoryValidationCheck($request);
        if($validation->fails()){
            return back()
                        ->withErrors($validation)
                        ->withInput();
        }
     $category =$this->getCategoryData($request);
     Category::where('category_id',$id)->update($category);
     return redirect()->route('admin#category')->with(['updateSuccess'=>'Category Updated!']);
    }

    //get category
    private function getCategoryData($request){
        return[
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    //categoryValidationCheck
    private function categoryValidationCheck($request){
        $validationRules =[
            'categoryName'=>'required',
            'categoryDescription'=>'required',
        ];
        return Validator::make($request->all(),$validationRules);
    }
}
