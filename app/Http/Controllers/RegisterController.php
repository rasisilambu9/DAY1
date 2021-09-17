<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller
{
    public function show(){
        return view('signup');
    }
    public function insert(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        $bpassword = bcrypt($password);

        $user = new User;

        $user->name      = $name;
        $user->email     = $email;
        $user->mobile    = $mobile;
        $user->password  = $bpassword;

        $user->save();

        return view('dashboard',['name'=>$name]);



    }
}
