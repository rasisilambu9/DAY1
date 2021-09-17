<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

use App\Models\User;

class UserController extends Controller
{
    public function show(){

        return view('login');

    }

    public function login(Request $request){

        $name = $request->input('email');
        $password = $request->input('password');

        $user = new User();

        $data = User::where('email',$name)->pluck('name');

        $passwor = User::where('email',$name)->pluck('password');
        
        if($data->isEmpty()){
            return redirect()->back()->with('Fail', 'User Not Found');  
        }
        
        if($password == $passwor[0]){
           
            return view('dashboard',['name'=>$data[0]]);

        }
        else{

            return redirect()->back()->with('Fail', 'You are Entered an Incorrect Password');  
        }

       

        
        



    }

    public function logout(){
        Auth::logout();
        return redirect('/login');

    }
}
