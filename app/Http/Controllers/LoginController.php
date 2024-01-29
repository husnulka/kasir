<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Homepage'
        );

        //return view('home', $data);
        return view('index', $data);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required', 'email',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('home');//cek di web.php nge route ke admin
            /*
            //mendaftarkan role user ke halaman mana di direct nya, daftarkan juga di web.php
            if(Auth::user()->role == 'operator'){                
                return redirect('admin/operator');
            }elseif(Auth::user()->role == 'kasir'){              
                return redirect('admin/keuangan');
            }elseif(Auth::user()->role == 'marketing'){              
                return redirect('admin/marketing');
            }*/
        }else{
            return redirect('')->withErrors('Username & password yang dimasukkan tidak sesuai.')->withInput();
        }
    }
    
    public function logout(){
        Auth::logout();
        return redirect('');
    }

     /*public function index(){
        $data = array(
            'title' => 'Login',
            'active' => 'login'
        );

        return view('login.index', $data);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }*/
}
