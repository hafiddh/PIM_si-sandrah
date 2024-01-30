<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        // dd($request->all());
        if(Auth::attempt($request->only('username', 'password'))){
            if(auth()->user()->level == 3){
                return redirect('/admin');
            }else if(auth()->user()->level == 2){
                return redirect('/keuangan');
            }else if(auth()->user()->level == 1){
                return redirect('/opd');
            }
        }
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
