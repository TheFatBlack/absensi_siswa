@extends('template-admin.layout')
@section('title', 'Dashboard Admin')
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
<!-- Ini adalah isi dashboard sesuai dengan template Guru Able -->
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-group-students bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Siswa <span>| Today</span></span>
                <h4>{{ $jumlahSiswa }}</h4>
                <div>
                    <span class=" f-left m-t-10 text-muted">
                        Total siswa yang terdaftar
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-teacher bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Guru <span>| Today</span></span>
                <h4>{{ $jumlahGuru }}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        Total Guru yang terdaftar
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- card1 end -->
    <!-- card1 start -->
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Kelas <span>| Today</span></span>
                <h4>{{ $jumlahLocal }}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        Total Kelas yang tersedia
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-engineer bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Jurusan <span>|
                        Today</span></span>
                <h4>{{ $jumlahJurusan }}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        Total jurusan yang tersedia
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan card lainnya sesuai kebutuhan -->
</div>
@endsection