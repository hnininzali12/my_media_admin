<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //profile direct page
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('user'));
    }

    //update admin acc
    public function updateAdminAcc(Request $request){
     $userData =$this->getUserData($request);
       $validator =$this->userValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

     User::where('id',Auth::user()->id)->update($userData);
     return back()->with(['updateSuccess'=>'Admin profile is updated']);
    }

    //change password
    public function changePassword(){
        return view('admin.profile.changePassword');
    }

    // update password
    public function updatePassword(Request $request){
        $validator =$this->passwordValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };

        $dbData= User::where('id',Auth::user()->id)->first();
        $dbPassword =$dbData->password;
        $hashNewPassword = Hash::make($request->newPassword);
        $updatePassword =[
            'password'=>$hashNewPassword,
            'updated_at'=>Carbon::now(),
        ];

        if(Hash::check($request->oldPassword,$dbPassword)){
          User::where('id',Auth::user()->id)->update($updatePassword);
          return redirect()->route('dashboard');
        }else{
          return back()->with(['fails'=>'Old Password do not match!']);
        }
    }

    //get user data
    private function getUserData($request){
        return[
            'name'=>$request->adminName,
            'email'=>$request->adminEmail,
            'phone'=>$request->adminPhone,
            'address'=>$request->adminAddress,
            'gender' =>$request->adminGender,
        ];
    }

    // validation
    //user validation
    private function userValidationCheck($request){
        $validation = Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required'=>'Your name field is empty.Please fill your name!',
            'adminEmail.required'=>'Your email field is empty.Please fill your email!',
        ]);
        return $validation;
    }

    //password validation

    private function passwordValidationCheck($request){
        $validationRules =[
                'oldPassword' =>'required|different:newPassword',
                'newPassword' =>'required|min:8|max:12',
                'confirmPassword' =>'required|same:newPassword|min:8|max:12',
        ];
        return
            Validator::make($request->all(),$validationRules);
    }
}
