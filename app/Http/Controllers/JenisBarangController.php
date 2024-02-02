<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data Jenis Barang',
            'data_jenis' =>JenisBarang::all(),
        );

        return view('admin.master.jenisbarang.list', $data);
    }
    
    public function store(Request $request){
       
        $dataTambah = [
            'nama_jenis' => $request->nama_jenis, 
        ];

        if(JenisBarang::create($dataTambah)){
            return redirect('/jenisBarang')->with('success', 'Data Berhasil Disimpan');
        }else{                        
            return redirect('/jenisBarang')->withErrors('Data Gagal Disimpan.')->withInput();
        }

        
    }

    public function update(Request $request, $id){
        JenisBarang::where('id', $id)
        ->where('id', $id)
        ->update([            
            'nama_jenis' => $request->nama_jenis, 
        ]);

        return redirect('/jenisBarang')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id){
        JenisBarang::where('id', $id)->delete();
        return redirect('/jenisBarang')->with('success', 'Data Berhasil Dihapus');
    }
}
