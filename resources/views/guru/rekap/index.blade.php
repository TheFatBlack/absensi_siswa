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
                <div class="card-block">
                    <form method="GET" action="{{ route('rekap.index') }}">
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select name="kelas" id="kelas-select" class="form-control">
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
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mb-3">Filter</button>
                        </div>
                    </form>
                    <script>
                    document.getElementById('btn-absen').addEventListener('click', function() {
                        var kelasId = document.getElementById('kelas-select').value;
                        if (!kelasId) {
                            alert('Silakan pilih kelas terlebih dahulu!');
                            return;
                        }
                        var url = "{{ route('absen.create') }}" + "?kelas=" + kelasId;
                        window.location.href = url;
                    });
                    </script>
                </div>
                @if(request('kelas') && $siswaKelas->count())
                <div class="mb-3">
                    <a href="{{ route('rekap.export.pdf', ['kelas' => request('kelas')]) }}" class="btn btn-danger"
                        target="_blank">
                        <i class="icofont icofont-file-pdf"></i> Download PDF
                    </a>
                    <a href="{{ route('rekap.export.excel', ['kelas' => request('kelas')]) }}" class="btn btn-success"
                        target="_blank">
                        <i class="icofont icofont-file-excel"></i> Download Excel
                    </a>
                </div>
                @endif
                @if(request('kelas') && $siswaKelas->count())
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Rekap Absen Detail Kelas {{$locals->firstWhere('id', request('kelas'))->nama ?? '-'}}</h5>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Status</th>
                                        <th>Total Hadir</th>
                                        <th>Total Sakit</th>
                                        <th>Total Izin</th>
                                        <th>Total Alpa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswaKelas as $siswaItem)
                                    @php
                                    $absens = $rekapAbsensi->where('id_siswa', $siswaItem->id)->sortBy('tanggal_absen');
                                    $totalHadir = $absens->where('status', 'hadir')->count();
                                    $totalSakit = $absens->where('status', 'sakit')->count();
                                    $totalIzin = $absens->where('status', 'izin')->count();
                                    $totalAlpa = $absens->where('status', 'alpa')->count();
                                    @endphp
                                    @foreach($absens as $absen)
                                    <tr>
                                        <td>{{ $siswaItem->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->translatedFormat('l') }}
                                        </td>
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
                                        <td>{{ $totalHadir }}</td>
                                        <td>{{ $totalSakit }}</td>
                                        <td>{{ $totalIzin }}</td>
                                        <td>{{ $totalAlpa }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection