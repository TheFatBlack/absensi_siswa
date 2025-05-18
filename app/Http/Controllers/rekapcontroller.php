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
    public function index()
    {
        $siswa = siswa::where('username', Auth::user()->username)->firstOrFail();
        $rekapAbsensi = mengabsen::where('id_siswa', $siswa->id)->with('guru')->get();

        return view('siswa.rekap.index', [
            'menu' => 'dashboard',
            'title' => 'Rekap Absensi ' . $siswa->nama,
            'siswa' => $siswa,
            'rekapAbsensi' => $rekapAbsensi
        ]);
    }
}