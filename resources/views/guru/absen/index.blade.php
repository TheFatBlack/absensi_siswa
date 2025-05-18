@extends('template-guru.layout')
@section('title', 'Data Absen')
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
<button class="btn btn-primary mb-3">
    <a href="{{route('absen.create')}}" style="color: inherit; text-decoration: none;">
        <i class="ti-plus"></i>Absen Siswa
    </a>
</button>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <h5>Management Data Absen</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <form method="GET" action="{{ route('absen.index') }}">
                        @csrf
                        <div class=" form-group row">
                            <div class="col-sm-10">
                                <select name="kelas" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($locals as $local)
                                    <option value="{{ $local->id }}"
                                        {{ request('kelas') == $local->id ? 'selected' : '' }}>
                                        {{ $local->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_absen" class="form-control"
                                    value="{{ request('tanggal_absen') }}">
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mb-3">Filter</button>
                        </div>
                    </form>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                        <th>Tanggal Absen</th>
                                        <th>Jam Absen</th>
                                        <th>Guru/wali kelas yang Mengabsen</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataabsen->sortByDesc('tanggal_absen') as $da)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$da->siswa->nama}}</td>
                                        <td>{{$da->siswa->local->nama}}</td>
                                        <td>{{$da->status}}</td>
                                        <td>{{$da->tanggal_absen}}</td>
                                        <td>{{$da->jam_absen}}</td>
                                        <td>{{$da->guru->nama}}</td>
                                        <td class="text-center text-nowrap" style="width: 120px;">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('absen.edit', $da->id) }}"
                                                    class="btn btn-outline-danger btn-sm" title="Edit">
                                                    <i class="ti-pencil-alt"></i>
                                                </a>
                                            </div>
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
</div>
@endsection