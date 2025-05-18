@extends('template-guru.layout')
@section('title', 'Data Rekap Absen')
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
                    <h5>Rekap Absensi {{$siswa->nama}}</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Status</th>
                                        <th>Guru/wali kelas yang Mengabsen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekapAbsensi->sortByDesc('tanggal_absen') as $rekap)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$rekap->tanggal_absen}}</td>
                                        <td>{{$rekap->jam_absen}}</td>
                                        <td>{{$rekap->status}}</td>
                                        <td>{{$rekap->guru->nama}}</td>
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
</div>
@endsection