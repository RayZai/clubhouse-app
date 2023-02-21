<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function Login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'email'=>'required',
            'password'=>'required'
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors('Invalid Inputs');
        }

        $user = User::where('email',$data['email'])->first();

        if(!$user){
            return redirect()->back()->withErrors('Incorrect Email');
        }
        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                        ->withSuccess('Signed in');
        }else{
            return redirect()->back()->withErrors('Incorrect Password');
        }


    }
    public function Logout(Request $request)
    {
        Session::flush();
        
        Auth::logout();
        return redirect()->route('login');
    }

}
