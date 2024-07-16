@extends('layout.layout')
@section('content')        
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>                           
                        </div> 
                    </div>
                    <hr/>

                    @if ($errors->any())
                        <div class="col-sm-12">
                            <div class="alert alert-danger" alert-dismissible fade show" role="alert">                            
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="col-sm-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        </div>
                    @endif

                    
                    <div class="card-body">   
                        <form method="POST" action="/transaksi/store">
                        @csrf                        
                        <button type="button" class="btn btn-sm btn-primary" data-target="#modalCreate" data-toggle="modal">
                            <i class="fa fa-plus"></i>Tambah Data
                        </button>

                        <hr />
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>                               
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Diskon</td>                                    
                                    <td>Diskon</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Total Bayar</td>                                    
                                    <td>Total Bayar</td>
                                </tr>
                            </tbody>         
                            </table>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Transaksi</label>
                                    <input type="text" class="form-control" name="no_transaksi" value="NT.001" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Transaksi</label>
                                    <input type="text" class="form-control" value="{{ date('d/M/Y') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Uang Pembeli</label>
                                    <input type="number" class="form-control" name="uang_pembeli" value="NT.001" required>
                                </div>
                                <div class="form-group">
                                    <label>kembalian</label>
                                    <input type="text" class="form-control" name="kembalian" value="{{ date('d/M/Y') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                            <a href="/transaksi" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                        </div>
                        
                        </form>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="/transaksi/cart">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label><br />
                        <select class="form-control" name="id_barang" required id="BarangId">
                            <option value="" hidden>-- Pilih Nama Barang --</option>
                            @foreach($data_jenis as $b)                            
                                <option value="{{ $b->id}}">{{ $b->nama_barang }}</option>
                            @endforeach                           
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Harga</label><br />
                        <input type="text" name="harga" class="form-control" placeholder="Harga" disabled required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control" placeholder="Stok" disabled required>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" name="stok" class="form-control" placeholder="Qty" required>
                    </div>
                    <div id="tampil_barang"></div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<script>

$(document).ready(function(){
    //bind change event once DOM is ready
    $('#BarangId').change(function(){});
    getResult($(this).val());

});


function getResult(selectedValue){
//call  ajax method to get data from database
$.ajax({
            type: "POST",
            url: "/transaksi/detailbarang",//this  should be replace by your server side method
            data: "{'value': '"+ selectedValue +"'}", //this is parameter name , make sure parameter name is sure as of your sever side method
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: false,
            success: function (Result) {
            alert(Result.d);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
}

function showDetailBarang(){
    alert("tes");
}
</script>

<!--**********************************
    Content body end
***********************************-->
@endsection