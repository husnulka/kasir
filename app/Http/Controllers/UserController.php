<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data User',
            //'data_user' =>User::all(),
        );

        return view('admin.master.user.list', $data);
    }
    
    public function store(Request $request){
        /*$this->validate($request,[
            'email' => 'email',
            'password' => 'required|confirmed|min:3',
        ]);*/

        user::create([
            'name' => $request-> name,
            'email' => $request-> email,
            'password' => Hash::make($request-> password),
            'role' => $request-> role,
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Disimpan');
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

    public function destroy($id){
        $data_user = user::where('id', $id)->delete();
        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
}
