@extends('template-guru.layout')
@section('title', 'Absen Siswa')
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
    <a href="{{route('absen.index')}}" style="color: inherit; text-decoration: none;">
        <i class="ti-arrow-left"></i>Kembali
    </a>
</button>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <h5>Absen Siswa</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <form method="GET" action="{{ route('absen.create') }}">
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
                            <form method="POST" action="{{ route('absen.updateStatus') }}">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th class="text-center">Alpa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datasiswa as $dg)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$dg->nama}}</td>
                                            <td>{{$dg->local->nama}}</td>
                                            <td>
                                                <input type="radio" name="status[{{ $dg->id }}]" value="hadir"
                                                    class="select-hadir">
                                            </td>
                                            <td>
                                                <input type="radio" name="status[{{ $dg->id }}]" value="sakit"
                                                    class="select-sakit">
                                            </td>
                                            <td>
                                                <input type="radio" name="status[{{ $dg->id }}]" value="alpa"
                                                    class="select-alpa">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ti-save"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection