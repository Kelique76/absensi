<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthCTRL extends Controller
{
    public function logindex(Request $req)
    {
        if(Auth::guard('pegawai')->attempt([
            'nik'=>$req->nik,
            'password'=>$req->password
        ])){
          return  redirect('/admin');
        }else{
           return redirect('/')->with(['warning'=>'Salah NIK/Password']);
        }
        //echo Hash::make($pass);
    }

    public function loginmindex(Request $req)
    {
        if(Auth::guard('user')->attempt([
            'email'=>$req->email,
            'password'=>$req->password
        ])){
          return  redirect('/panel/admindash');
        }else{
           return redirect()->back()->with(['warning'=>'Salah Email/Password']);
        }
    }

    public function logoutUser()
    {
        if(Auth::guard('pegawai')->check()){
            Auth::guard('pegawai')->logout();
            return  redirect('/');
        }

        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return  redirect('/admins');
        }
    }
}
