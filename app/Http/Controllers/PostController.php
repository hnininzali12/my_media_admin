<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
     public function index() {
        $category = Category::get();
        $postData = Post::get();
        return view('admin.post.index',compact('category','postData'));
    }

    //post create
    public function postCreate(Request $request){
        $validator =$this->postValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
       if(!empty($request->postImage)){
         $file = $request->file('postImage');
       $fileName = uniqid().'_'.$file->getClientOriginalName();
       $file->move(public_path().'/postImage',$fileName);
       $postData =$this->getPostData($request,$fileName);
       }else{
       $postData =$this->getPostData($request,NULL);
       }
       Post::create($postData);
       return back();
    }

    //delete post
    public function postDelete($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];
        Post::where('post_id',$id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        };
        return back()->with(['deleteSuccess'=>'Post deleted!']);
    }

    //post edit page
    public function postEdit($id){
        $postData = Post::where('post_id',$id)->first();
        $category =Category::get();
        $post = Post::get();
        return view('admin.post.edit',compact('postData','category','post'));
    }

    //post update
    public function postUpdate($id,Request $request){
        $validator =$this->postValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->getUpdatePostData($request);
        if(isset($request->postImage)){
          $this->storeNewImage($id,$request,$data);
        }else{
            Post::where('post_id',$id)->update($data);
        }
        return back()->with(['updateSuccess'=>'Post Updated!']);
    }

    //store new image
    private function storeNewImage($id,$request,$data){
        //get image file name from client
          $file = $request->file('postImage');
          $fileName = uniqid().'_'.$file->getClientOriginalName();
          $data['image'] = $fileName;

          //get image file name from dataBase
          $postData =Post::where('post_id',$id)->first();
          $dbImageName =$postData['image'];

          //delete image file from public path
          if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
          }

          //replace new image
          $file->move(public_path().'/postImage',$fileName);
          //update new data with new image
          Post::where('post_id',$id)->update($data);
    }
    //get post data
    private function getPostData($request,$fileName){
        return[
            'title' =>$request->postTitle,
            'description' =>$request->postDescription,
            'image'=>$fileName,
            'category_id' =>$request->postCategory,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    //get update post data
    private function getUpdatePostData($request){
        return[
            'title' =>$request->postTitle,
            'description' =>$request->postDescription,
            'category_id' =>$request->postCategory,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    //post validation check
    private function postValidationCheck($request){
        return Validator::make($request->all(),[
            'postTitle' =>'required',
            'postDescription' =>'required',
            'postCategory' =>'required',
        ]);
    }
}
