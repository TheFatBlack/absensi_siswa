@extends('template-admin.layout')
@section('title', 'Tambah Data Jurusan')
@section('css')
<link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">
@endsection

@section('konten')
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Jurusan</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="{{ route('jurusan.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Jurusan<span
                                    class="text-muted">(contoh pengisian: RPL 1)</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="masukkan nama jurusan" required>
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="2">

                        <div class="text-end">
                            <a href="{{route('jurusan.index')}}" class="btn btn-primary">
                                <i class="ti-arrow-left"></i> Kembali
                            </a>
                            <button type="reset" class="btn btn-warning">
                                <i class="ti-reload"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="ti-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection