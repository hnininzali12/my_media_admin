<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminListController extends Controller
{
    //admin list direct page
    public function index() {
        if(Session::get('ADMIN_SEARCH')){
            Session::forget('ADMIN_SEARCH');
        }
        $userData =User::select('id','name','email','gender','phone','address')->get();
         if(count($userData) == 0){
            $emptyStatus =0;
        }else{
            $emptyStatus =1;
        };
        return view('admin.list.index',compact('userData','emptyStatus'));
    }

    //delete admin acc
     public function deleteAcc($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account deleted!']);
     }

     //search admin list
     public function searchAdminList(Request $request){
      $searchKey=$request->adminSearchKey;
       $userData =User::orwhere('name','like','%'. $searchKey.'%')
                         ->orwhere('email','like','%'. $searchKey.'%')
                         ->orwhere('phone','like','%'. $searchKey.'%')
                         ->orwhere('address','like','%'. $searchKey.'%')
                         ->orwhere('gender','like','%'. $searchKey.'%')
                         ->get();
        Session::put('ADMIN_SEARCH',$searchKey);
        if(count($userData) == 0){
            $emptyStatus =0;
        }else{
            $emptyStatus =1;
        };
        return view('admin.list.index',compact('userData','emptyStatus'));
     }
}
