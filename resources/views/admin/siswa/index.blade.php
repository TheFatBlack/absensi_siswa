@extends('template-admin.layout')
@section('title', 'Data Siswa')
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
    <a href="{{route('siswa.create')}}" style="color: inherit; text-decoration: none;">
        <i class="ti-plus"></i>Tambah Data Siswa
    </a>
</button>
<div class="page-body">
    <!-- Basic table card start -->
    <div class="card">
        <div class="card-header">
            <h5>Manajemen Data Siswa</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="icofont icofont-simple-left "></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nisn</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datasiswa as $ds)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$ds->nisn}}</td>
                            <td>{{$ds->nama}}</td>
                            <td>{{$ds->local->nama}}</td>
                            <td class="text-center text-nowrap" style="width: 120px;">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('siswa.show', $ds->id) }}"
                                        class="btn btn-outline-primary btn-sm mr-3" title="Lihat">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{route('siswa.edit',$ds['id'])}}"
                                        class="btn btn-outline-warning btn-sm mr-3" title="Edit">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('siswa.destroy',$ds['id'])}}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
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
@endsection