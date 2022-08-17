<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get post List
    public function allPostList(){
        $post = Post::select('posts.*','categories.title as category_title')
                       ->join('categories','posts.category_id','categories.category_id')
                       ->get();
        return response()->json([
            'post'=>$post,
        ]);
    }

    //search post
    public function searchPost(Request $request){
        $post = Post::select('posts.*','categories.title as category_title')
                       ->join('categories','posts.category_id','categories.category_id')
                       ->where('posts.title','like','%'.$request->key.'%')
                       ->get();
        return response()->json([
            'searchData' =>$post,
        ]);
    }

    //autocomplete
    public function autocompleteSearch(Request $request){
          $post = Post::select('posts.*')
                       ->where('posts.title','like','%'.$request->key.'%')
                       ->get();
        return response()->json([
            'searchData' =>$post,
        ]);
    }
    //post details
    public function postDetails(Request $request){
        $post = Post::where('post_id',$request->postId)->first();
        return response()->json([
            'post'=>$post,
        ]);
    }
}
