@extends('template-admin.layout')
@section('title', 'Show Data ' . $siswa->nama)
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
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Show Data {{$siswa->nama}}</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>

                </div>
                <div class="card-block">
                    <form>
                        @csrf
                        <div class=" form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{$siswa->username}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select name="id_local" id="id_local" class="form-control" disabled>
                                    <option disabled selected value="{{$siswa->local_id}}">
                                        {{ $siswa->local ? $siswa->local->nama : 'Pilih Kelas' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jk" id="jk" class="form-control" disabled>
                                    <option disabled selected value="{{$siswa->jk}}">{{$siswa->jk}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea rows="5" cols="5" name="alamat" id="alamat" class="form-control"
                                    disabled>{{$siswa->alamat}}</textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nohp" name="nohp" value="{{$siswa->nohp}}"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_wm" class="col-sm-2 col-form-label">Nama WaliMurid</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_wm" name="nama_wm"
                                    value="{{$siswa->nama_wm}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat_wm" class="col-sm-2 col-form-label">Alamat WaliMurid</label>
                            <div class="col-sm-10">
                                <textarea rows="5" cols="5" name="alamat_wm" id="alamat_wm" class="form-control"
                                    disabled>{{ $siswa->alamat_wm }}</textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nohp_wm" class="col-sm-2 col-form-label">Nomor Handphone WaliMurid</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nohp_wm" name="nohp_wm"
                                    value="{{$siswa->nohp_wm}}" disabled>
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="2">
                        <div class="text-end">
                            <a href="{{ route('siswa.index') }}" class="btn btn-primary">
                                <i class="ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection