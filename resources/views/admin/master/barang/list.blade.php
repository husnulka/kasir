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
                            <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i>Tambah Data
                            </button>
                        </div> 
                    </div>

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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($data_barang as $row)                                    
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_barang }}</td>
                                            <td>{{ $row->nama_jenis }}</td>
                                            <td>{{ $row->stok }} pcs</td>
                                            <td>Rp. {{ number_format($row->harga) }}</td>
                                            <td>
                                                <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                                
                            </table>
                        </div>
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
            <form method="POST" action="/barang/store">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <select class="form-control" name="id_jenis" required>
                            <option value="" hidden>-- Pilih Jenis Barang --</option>
                            @foreach($data_jenis as $b)                            
                                <option value="{{ $b->id}}">{{ $b->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                        <div class="input-group-append"><span class="input-group-text">pcs</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

@foreach ($data_barang as $d) 
    <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/barang/update/{{ $d->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="{{ $d->nama_barang }}" placeholder="Nama Barang" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <select class="form-control" name="id_jenis" required>
                                <option value="{{ $d->id_jenis }}">{{ $d->nama_jenis }}</option>
                                @foreach($data_jenis as $b)                            
                                    <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="stok" value="{{ $d->stok }}" class="form-control" placeholder="Stok" required>
                            <div class="input-group-append"><span class="input-group-text">pcs</span></div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                            <input type="number" name="harga" value="{{ $d->harga }}" class="form-control" placeholder="Harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endforeach

@foreach ($data_barang as $c) 
    <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="GET" action="/barang/destroy/{{ $c->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Apakah Anda Ingin Menghapus Data {{ $c->nama_barang }} Ini?</h5>                            
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endforeach

<!--**********************************
    Content body end
***********************************-->
@endsection