<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data User',
            'data_user' =>User::all(),
        );

        return view('admin.master.user.list', $data);
    }

    public function profile(){
        $user = Auth::user()->id;
        $data = array(
            'title' => 'Setting Profile',
            'data_profile' =>User::where('id', $user)->get(),
        );

        return view('profile', $data);
    }
    
    public function store(Request $request){
        /*$this->validate($request,[
            'email' => 'email',
            'password' => 'required|confirmed|min:3',            
        ]);*/

        /*
        //nanti dibuka untuk validasi email tidak boleh ada yg sama
        $this->validate($request,[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|between:6,255|confirmed',
        ]);*/

        $dataTambah = [
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request-> password), 
            'role' => $request->role,
        ];

        if(user::create($dataTambah)){
            return redirect('/user')->with('success', 'Data Berhasil Disimpan');
        }else{            
            //return redirect('/user')->with('error', 'Data Gagal Disimpan');
            
            return redirect('/user')->withErrors('Data Gagal Disimpan.')->withInput();
        }

        
    }

    public function update(Request $request, $id){
        user::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request-> name,
            'email' => $request-> email,
            'password' => Hash::make($request-> password),
            'role' => $request-> role,
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Diubah');
    }

    public function updateprofile(Request $request, $id){
        user::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request-> name,
            'email' => $request-> email,
            'password' => Hash::make($request-> password),
            'role' => $request-> role,
        ]);

        return redirect('/profile')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id){
        $data_user = user::where('id', $id)->delete();
        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
}
