@extends('template-siswa.layout')
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
                <div class="card-block">
                    <h5>Rekap Absen {{ $siswa->nama }} ({{ $siswa->local->nama ?? '-' }})</h5>

                    <form method="GET" action="{{ route('rekap.index') }}" class="mb-3">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('rekap.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jam Masuk</th>
                                    <th>Hari</th>
                                    <th>Status</th>
                                    <th>Guru/Walikelas</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $filtered = $rekapAbsensi;
                                if(request('bulan')) {
                                $bulan = \Carbon\Carbon::parse(request('bulan'));
                                $filtered = $filtered->filter(function($item) use ($bulan) {
                                return \Carbon\Carbon::parse($item->tanggal_absen)->month == $bulan->month
                                && \Carbon\Carbon::parse($item->tanggal_absen)->year == $bulan->year;
                                });
                                }
                                if(request('tanggal')) {
                                $filtered = $filtered->where('tanggal_absen', request('tanggal'));
                                }
                                $totalHadir = $filtered->where('status', 'hadir')->count();
                                $totalSakit = $filtered->where('status', 'sakit')->count();
                                $totalIzin = $filtered->where('status', 'izin')->count();
                                $totalAlpa = $filtered->where('status', 'alpa')->count();
                                @endphp
                                @forelse($filtered as $i => $absen)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->translatedFormat('F') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('Y') }}</td>
                                    <td>{{ $absen->jam_absen ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->translatedFormat('l') }}</td>
                                    <td>
                                        @if($absen->status == 'hadir')
                                        <span class="badge bg-success">Hadir</span>
                                        @elseif($absen->status == 'sakit')
                                        <span class="badge bg-warning">Sakit</span>
                                        @elseif($absen->status == 'izin')
                                        <span class="badge bg-info">Izin</span>
                                        @else
                                        <span class="badge bg-danger">Alpa</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $absen->guru->nama ?? $absen->walikelas->nama ?? '-' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data absen.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8">
                                        Total Hadir: {{ $totalHadir }} |
                                        Sakit: {{ $totalSakit }} |
                                        Izin: {{ $totalIzin }} |
                                        Alpa: {{ $totalAlpa }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection