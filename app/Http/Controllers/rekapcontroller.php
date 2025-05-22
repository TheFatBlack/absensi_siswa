<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\local;
use App\Models\Siswa;
use App\Models\Mengabsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class rekapcontroller extends Controller
{
    public function index(Request $request)
    {
        $locals = local::all();
        $user = Auth::user();

        if ($user->level === 'guru' || $user->level === 'walikelas') {
            $siswa = null; 
            $siswaKelas = collect();
            $rekapAbsensi = collect();

            if ($request->kelas) {
                $siswaKelas = Siswa::where('id_local', $request->kelas)->get();
                $rekapAbsensi = Mengabsen::whereIn('id_siswa', $siswaKelas->pluck('id'));

                if ($request->bulan) {
                    $rekapAbsensi = $rekapAbsensi->whereMonth('tanggal_absen', Carbon::parse($request->bulan)->month)
                                                 ->whereYear('tanggal_absen', Carbon::parse($request->bulan)->year);
                }
                if ($request->tanggal) {
                    $rekapAbsensi = $rekapAbsensi->whereDate('tanggal_absen', $request->tanggal);
                }

                $rekapAbsensi = $rekapAbsensi->get();
            }

            return view('guru.rekap.index', [
                'menu' => 'rekap',
                'title' => 'Rekap Absensi Kelas',
                'siswa' => $siswa,
                'rekapAbsensi' => $rekapAbsensi,
                'locals' => $locals,
                'siswaKelas' => $siswaKelas
            ]);
        }

        // Untuk siswa
        $siswa = Siswa::where('username', $user->username)->firstOrFail();
        $rekapAbsensi = Mengabsen::where('id_siswa', $siswa->id);

        if ($request->bulan) {
            $rekapAbsensi = $rekapAbsensi->whereMonth('tanggal_absen', Carbon::parse($request->bulan)->month)
                                         ->whereYear('tanggal_absen', Carbon::parse($request->bulan)->year);
        }
        if ($request->tanggal) {
            $rekapAbsensi = $rekapAbsensi->whereDate('tanggal_absen', $request->tanggal);
        }

        $rekapAbsensi = $rekapAbsensi->get();
        $siswaKelas = collect();

        return view('siswa.rekap.index', [
            'menu' => 'rekap',
            'title' => 'Rekap Absensi ' . $siswa->nama,
            'siswa' => $siswa,
            'rekapAbsensi' => $rekapAbsensi,
            'locals' => $locals,
            'siswaKelas' => $siswaKelas
        ]);
    }
}