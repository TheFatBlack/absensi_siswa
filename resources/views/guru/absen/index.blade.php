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
<div class="card-block">
    <form method="GET" action="{{ route('absen.index') }}">
        <div class="form-group row">
            <div class="col-sm-10">
                <select name="kelas" id="kelas-select" class="form-control">
                    <option value="">Pilih Kelas</option>
                    @foreach($locals as $local)
                    <option value="{{ $local->id }}" {{ request('kelas') == $local->id ? 'selected' : '' }}>
                        {{ $local->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary mb-3">Filter</button>
            <button type="button" id="btn-absen" class="btn btn-success mb-3">
                <i class="ti-plus"></i>Absen Siswa
            </button>
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
    @if(request('kelas'))
    <div class="card-block table-border-style mt-3">
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
                    @forelse($dataabsen as $da)
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
                                <a href="{{ route('absen.edit', $da->id) }}" class="btn btn-outline-danger btn-sm"
                                    title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data absen untuk kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection