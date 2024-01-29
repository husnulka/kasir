<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data User',
            //'data_user' =>User::all(),
        );
        //resources/views/admin/master/user/list.blade.php
        //return view('admin.master.user.list', $data);

        echo "Halo selamat datang";
        echo "<h1>".Auth::user()->name."</h1>";
        echo "<a href='/logout'>logout >> </a>";
    }

    public function operator(){
        echo "Halo selamat datang di halaman operator";
        echo "<h1>".Auth::user()->name."</h1>";
        echo "<a href='/logout'>logout >> </a>";
    }

    public function keuangan(){
        echo "Halo selamat datang di halaman keuangan";
        echo "<h1>".Auth::user()->name."</h1>";
        echo "<a href='/logout'>logout >> </a>";
    }

    public function marketing(){
        echo "Halo selamat datang di halaman marketing";
        echo "<h1>".Auth::user()->name."</h1>";
        echo "<a href='/logout'>logout >> </a>";
    }
}
