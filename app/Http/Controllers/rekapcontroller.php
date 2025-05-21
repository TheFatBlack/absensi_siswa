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
            $rekapAbsensi = Mengabsen::whereIn('id_siswa', $siswaKelas->pluck('id'))->get();
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

    $siswa = siswa::where('username', $user->username)->firstOrFail();
    $rekapAbsensi = mengabsen::where('id_siswa', $siswa->id)->with('guru')->get();
    $siswaKelas = collect();

    if ($request->kelas) {
        $siswaKelas = Siswa::where('id_local', $request->kelas)->get();
        $rekapAbsensi = Mengabsen::whereIn('id_siswa', $siswaKelas->pluck('id'))->get();
    }

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