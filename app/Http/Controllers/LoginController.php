<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect()->route('mypage');
        }
        $backurl=parse_url(url()->previous());
        if($backurl['host']==$_SERVER['HTTP_HOST']){
            switch($backurl['path']){
                case '/':
                case '/login':
                case '/register':
                case '/logout':
                    break;
                default:
                    session(['back_path'=>$backurl['path']]);
                    break;
            }
        }
        return view('login');
    }

    public function login(Request $request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials)){
            if(session()->has('back_path')){
                $back_path=session('back_path');
                session()->forget('back_path');
                return redirect($back_path);
            }
            return redirect()->route('mypage');
        }

        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('top');
    }
}
