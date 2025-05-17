<!-- @extends('template-guru.layout')
@section('title', 'Dashboard Guru')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Selamat datang, Guru {{ Auth::user()->name }}</h1>
            <div class="card">
                <div class="card-header">
                    <h5>Informasi</h5>
                </div>
                <div class="card-body">
                    <p>Untuk melakukan absensi, silakan pilih menu <strong>Absensi</strong> di navigasi atas.</p>
                    <p>Pastikan data absensi siswa sudah diperiksa sebelum disimpan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->