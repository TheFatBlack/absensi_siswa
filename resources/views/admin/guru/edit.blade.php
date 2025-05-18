@extends('template-admin.layout')
@section('title', 'Mengedit Data' . $guru->nama)
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
                    <h5>Edit Data {{$guru->nama}}</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>

                </div>
                <div class="card-block">
                    <form action="{{route('guru.update', $guru->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class=" form-group row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nip" name="nip" value="{{$guru->nip}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{$guru->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{$guru->username}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10 position-relative">
                                <input type="password" class="form-control pr-5" id="password" name="password"
                                    placeholder="biarkan kosong jika tidak ingin mengganti password">
                                <i class="ti-eye mr-3" id="togglePassword"
                                    style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"
                                    title="Lihat password"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jk" id="jk" class="form-control" require>
                                    <option disabled selected value="{{$guru->jk}}">{{$guru->jk}}</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nohp" name="nohp" value="{{$guru->nohp}}">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{$guru->tanggal_lahir}}">
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="2">
                        <div class="text-end">
                            <a href="{{route('guru.index')}}" class="btn btn-primary">
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
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    let visible = false;

    togglePassword.addEventListener('click', function() {
        visible = !visible;

        if (visible) {
            passwordInput.setAttribute('type', 'text');
            this.style.color = "#007bff";
            this.setAttribute('title', 'Sembunyikan password');
        } else {
            passwordInput.setAttribute('type', 'password');
            this.style.color = "";
            this.setAttribute('title', 'Lihat password');
        }
    });
});
</script>
@endsection