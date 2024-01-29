<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Homepage'
        );

        //return view('home', $data);
        return view('index', $data);
    }

    /*
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
            return redirect('user');//cek di web.php nge route ke user
        }else{
            return redirect('')->withErrors('Username & password yang dimasukkan tidak sesuai.')->withInput();
        }
    }
    
    public function logout(){
        Auth::logout();
        return redirect('');
    }*/

}
