@extends('template-admin.layout')
@section('title', 'Mengedit Data ' . $siswa->nama)
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
                    <h5>Tambah Data Siswa</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>

                </div>
                <div class="card-block">
                    <form action="{{route('siswa.update', $siswa->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class=" form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nisn" name="nisn"
                                    value="{{$siswa->nisn}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{$siswa->username}}">
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
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select name="id_local" id="id_local" class="form-control">
                                    <option disabled selected value="{{$siswa->local_id}}">
                                        {{ $siswa->local ? $siswa->local->nama : 'Pilih Kelas' }}</option>
                                    @foreach($kelas as $k)
                                    <option value="{{$k['id']}}">{{$k['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jk" id="jk" class="form-control">
                                    <option disabled selected value="{{$siswa->jk}}">{{$siswa->jk}}</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea rows="5" cols="5" name="alamat" id="alamat"
                                    class="form-control">{{$siswa->alamat}}</textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nohp" name="nohp"
                                    value="{{$siswa->nohp}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_wm" class="col-sm-2 col-form-label">Nama WaliMurid</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_wm" name="nama_wm"
                                    value="{{$siswa->nama_wm}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat_wm" class="col-sm-2 col-form-label">Alamat WaliMurid</label>
                            <div class="col-sm-10">
                                <textarea rows="5" cols="5" name="alamat_wm" id="alamat_wm" class="form-control"
                                    placeholder="masukkan alamat walimurid" required></textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="nohp_wm" class="col-sm-2 col-form-label">Nomor Handphone WaliMurid</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nohp_wm" name="nohp_wm"
                                    value="{{$siswa->nohp_wm}}">
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="2">
                        <div class="text-end">
                            <a href="{{route('siswa.index')}}" class="btn btn-primary">
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