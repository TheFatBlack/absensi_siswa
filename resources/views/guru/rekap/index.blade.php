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
<style>
.btn-custom {
    background-color: white;
    color: #333;
    border: 1px solid #ccc;
    padding: 3px 10px;
    font-size: 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: 0.2s ease-in-out;
    min-width: 110px;
    text-align: center;
}

.btn-custom:hover {
    background-color: #f1f1f1;
}

.d-flex {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.gap-2 {
    gap: 8px;
}
</style>
@endsection
@section('konten')
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <form method="GET" action="{{ route('rekap.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="kelas" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($locals as $local)
                                    <option value="{{ $local->id }}"
                                        {{ request('kelas') == $local->id ? 'selected' : '' }}>
                                        {{ $local->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
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
                <div class="mb-3 d-flex gap-2" style="margin-left: 10px;">
                    <button onclick="exportTableToExcel('myTable', 'data-excel')" class="btn-custom ms-2">Download
                        Excel</button>
                    <button onclick="downloadPDF()" class="btn-custom">Download PDF</button>
                    <button onclick="printTable()" class="btn-custom">Print</button>
                </div>
                @if(request('kelas') && $siswaKelas->count())
                <div class="card mt-3 ">
                    <div class="card-header">
                        <h5>Rekap Absen Detail Kelas {{$locals->firstWhere('id', request('kelas'))->nama ?? '-'}}</h5>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Jam Masuk</th>
                                        <th>Status</th>
                                        <th>Guru/Walikelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    // Inisialisasi total
                                    $totalHadir = 0;
                                    $totalSakit = 0;
                                    $totalIzin = 0;
                                    $totalAlpa = 0;
                                    @endphp
                                    @foreach($siswaKelas as $siswaItem)
                                    @php
                                    $absens = $rekapAbsensi->where('id_siswa', $siswaItem->id)->sortBy('tanggal_absen');
                                    @endphp
                                    @foreach($absens as $absen)
                                    @php
                                    if($absen->status == 'hadir') $totalHadir++;
                                    if($absen->status == 'sakit') $totalSakit++;
                                    if($absen->status == 'izin') $totalIzin++;
                                    if($absen->status == 'alpa') $totalAlpa++;
                                    @endphp
                                    <tr>
                                        <td>{{ $siswaItem->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->translatedFormat('l') }}
                                        </td>
                                        <td>{{ $absen->jam_absen ?? '-' }}</td>
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
                                        <td>{{ $absen->guru->nama ?? $absen->walikelas->nama ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">
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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
function exportTableToExcel(tableID, filename = '') {
    let dataType = 'application/vnd.ms-excel';
    let tableSelect = document.getElementById(tableID);
    let tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    filename = filename ? filename + '.xls' : 'excel_data.xls';

    let downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        let blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}

function downloadPDF() {
    const {
        jsPDF
    } = window.jspdf;
    html2canvas(document.querySelector("#myTable")).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF();
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save("data.pdf");
    });
}

function printTable() {
    let printContents = document.getElementById('myTable').outerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // agar reload kembali konten penuh
}
</script>
@endsection