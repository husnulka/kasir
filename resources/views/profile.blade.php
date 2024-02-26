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
                    <hr/>
                    @foreach ($data_profile as $d)
                    
                    <form method="post" action="/profile/updateprofile/{{ $d->id }}">
                        @csrf
                        <div class="card-body">                            
                            <input type="hidden" name="role" value="{{ $d->role }}">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $d->name }}" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $d->email }}" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="{{ $d->password }}" class="form-control" placeholder="Password" required>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save">Save Changes</i></button>
                        </div>
                    </form>                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<!--**********************************
    Content body end
***********************************-->
@endsection