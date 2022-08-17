<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get category
    public function allCategoryList(){
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'category'=>$category,
        ]);
    }

    //search category
    public function categorySearch(Request $request){
       $search =Category::select('posts.*','categories.title as category_title')
                         ->join('posts','categories.category_id','posts.category_id')
                         ->where('categories.category_id',$request->key)
                         ->get();
        return response()->json([
            'result' =>$search,
        ]);

    }
}
