@extends('template-guru.layout')
@section('title', 'Ubah status absen' . $mengabsen->siswa->nama)
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
                    <h5>Edit Data {{$mengabsen->siswa->nama}}</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                </div>
                <div class="card-block">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('absen.update', $mengabsen->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="status" name="status">
                                            <option value="hadir" {{ $mengabsen->status == 'hadir' ? 'selected' : '' }}>
                                                Hadir</option>
                                            <option value="sakit" {{ $mengabsen->status == 'sakit' ? 'selected' : '' }}>
                                                Sakit</option>
                                            <option value="izin" {{ $mengabsen->status == 'izin' ? 'selected' : '' }}>
                                                Izin</option>
                                            <option value="alpa" {{ $mengabsen->status == 'alpa' ? 'selected' : '' }}>
                                                Alpa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="{{route('absen.index')}}" class="btn btn-primary">
                                        <i class="ti-arrow-left"></i> Kembali
                                    </a>
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
    </div>
</div>
@endsection