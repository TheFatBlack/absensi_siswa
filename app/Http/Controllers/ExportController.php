<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\local;
use App\Models\Siswa;
use App\Models\Mengabsen;
use App\Exports\RekapExport;

class ExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $kelas = $request->kelas;
        $locals = local::all();
        $siswaKelas = Siswa::where('id_local', $kelas)->get();
        $rekapAbsensi = Mengabsen::whereIn('id_siswa', $siswaKelas->pluck('id'))->get();

        $pdf = PDF::loadView('guru.rekap.pdf', compact('locals', 'siswaKelas', 'rekapAbsensi'));
        return $pdf->download('rekap-absen-kelas-'.$kelas.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $kelas = $request->kelas;
        return Excel::download(new RekapExport($kelas), 'rekap-absen-kelas-'.$kelas.'.xlsx');
    }
}