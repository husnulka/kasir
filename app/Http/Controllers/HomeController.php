<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Homepage'
        );

        //return view('home', $data);
        return view('index', $data);
    }
}
