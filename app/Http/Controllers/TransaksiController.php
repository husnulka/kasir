<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function index(){
        $data = array(
            'title'         => 'Data Transaksi',
            'data_transaksi'=> Transaksi::all(),   
        );

        return view('kasir.transaksi.list', $data);
    }

    public function create(){
        $data = array(
            'title'         => 'Create Data Transaksi',         
            'data_jenis'    => Barang::all(),
        );

        return view('kasir.transaksi.add', $data);
    }

    public function detailbarang(){
        $data = array(
            'title'         => 'Create Data Transaksi',         
            'data_barang'    => Barang::all(),
        );

        return $data;
    }
    
    

}
