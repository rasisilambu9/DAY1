<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Customer;
use App\Models\Products;
class CustomerController extends Controller
{


    public function apiinsert(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        $bpassword = Hash::make($password);

        $customer = new Customer;

        $customer->name      = $name;
        $customer->email     = $email;
        $customer->mobile    = $mobile;
        $customer->password  = $bpassword;

        $customer->save();

        return response()->json(['success'=>"User Registered Successfully",
                                    'email'=>$email,
                                     'mobile'=>$mobile,
                                      'name'=>$name]);
    }
    public function apilogin(Request $request){

        $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
 
        $customer = Customer::where('email',$request->input('email'))->first();
 
        if(!$customer || !Hash::check($request->password,$customer->password)){
 
            return response()->json('user not found');
        }
        else{
 
         $token = $customer->createToken('Customer Token ');
         return $token;
 
 
        }
     }

     public function showproducts(){


        // $pdt = (Products::all()->where('approve_status',1));

        
        
        
        return response()->json(Products::all()->where('approve_status',1));
        
        
        

    }
    public function logout(Request $request) {
        
        if ($request->user()) { 
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged Out Successfully'], 200);
        }
    
        
    }

    public function purchase(Request $request,$id){


        





    }

}
