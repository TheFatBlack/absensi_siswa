@extends('template-admin.layout')
@section('title', 'Mengedit Data ' . $local->nama)
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
                    <h5>Edit Data {{$local->nama}}</h5>
                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>

                </div>
                <div class="card-block">
                    <form action="{{route('local.update', $local->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Angkatan</label>
                            <div class="col-sm-10">
                                <select name="nama" id="nama" class="form-control" required>
                                    <option disabled selected value="">Pilih Angkatan</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                    <option value="XIII">XIII</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                            <div class="col-sm-10">
                                <select name="id_jurusan" id="id_jurusan" class="form-control" required>
                                    <option disabled selected value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{$j['id']}}">{{$j['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="id_guru" class="col-sm-2 col-form-label">Wali Kelas</label>
                            <div class="col-sm-10">
                                <select name="id_guru" id="id_guru" class="form-control" required>
                                    <option disabled selected value="">Pilih Wali Kelas</option>
                                    @foreach($guru as $g)
                                    <option value="{{$g->id}}" @if(in_array($g->id, $guru_terpakai))
                                        disabled @endif>{{$g->nama}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id_user" value="2">
                        <div class="text-end">
                            <a href="{{route('local.index')}}" class="btn btn-primary">
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