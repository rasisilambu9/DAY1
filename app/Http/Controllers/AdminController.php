<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;
use App\Models\Products;
use App\Models\ProdImage;
use App\Models\Video;

use Auth;


class AdminController extends Controller{
    
    public function apilogin(Request $request){
        
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
 
        $admin = Admin::where('email',$request->input('email'))->first();
        if(!$admin || !Hash::check($request->password,$admin->password))
        {
            return response()->json('user not found');
        }
        else
        {
            $token = $admin->createToken('Admin Token');
            return $token;
        }
    }

    
    public function showproducts()
    {
        $pdt = Products::all();       
        return $pdt;      
    }

    public function approveproducts(Request $request,$id)
    {

        $status = $request->input('status');

        $update = Products::where('id',$id)->update(['approve_status' => $status]);
        $up = ProdImage::where('id',$id)->update(['approve_status'=>$status]);
        $video = Video::where('id',$id)->update(['approve_status'=>$status]);


        return response()->json(['message' => 'Product Status Updated'], 200);       

    }



    public function logout(Request $request) {
        if ($request->user()) 
        { 
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged Out Successfully'], 200);
        }
    }
}