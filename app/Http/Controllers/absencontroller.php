<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Local;
use App\Models\Siswa;
use App\Models\Mengabsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        $query = Mengabsen::with(['siswa', 'guru']);

        if ($request->has('kelas') && $request->kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_local', $request->kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal_absen', $request->tanggal_absen);
        }

        $dataabsen = $query->get();
        $locals = local::all();

        return view('guru.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'dataabsen' => $dataabsen,
            'locals' => $locals
        ]);
    }

    public function create(Request $request)
    {
        $query = Siswa::with('local');

        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('id_local', $request->kelas);
        }

        $datasiswa = $query->get();
        $locals = Local::all();

        return view('guru.absen.create', [
            'menu' => 'absen',
            'title' => 'Absen Siswa',
            'datasiswa' => $datasiswa,
            'locals' => $locals
        ]);
    }

    public function updateStatus(Request $request)
{
    foreach ($request->status as $id_siswa => $status) {
        $tanggal = $request->tanggal_absen ?? now()->toDateString();
        $jam = $request->jam_absen ?? now()->format('H:i');

        // Cek apakah sudah ada absen untuk siswa, tanggal, dan jam ini
        $absen = \App\Models\Mengabsen::where('id_siswa', $id_siswa)
            ->whereDate('tanggal_absen', $tanggal)
            ->where('jam_absen', $jam)
            ->first();

        if ($absen) {
            $absen->status = $status;
            $absen->updated_at = now();
            $absen->save();
        } else {
            \App\Models\Mengabsen::create([
    'id_siswa'      => $id_siswa,
    'tanggal_absen' => $tanggal,
    'jam_absen'     => $jam,
    'status'        => $status,
    'id_guru'       => Auth::id(),
]);
        }
    }
    return redirect()->route('absen.index')->with('success', 'Absen berhasil disimpan/diupdate!');
}

    public function edit($id)
    {
        $mengabsen = Mengabsen::with('siswa.local')->findOrFail($id);
        return view('guru.absen.ubah', [
            'menu' => 'absen',
            'title' => 'Edit Absen',
            'mengabsen' => $mengabsen
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'Status harus diisi',
        ]);

        $mengabsen = Mengabsen::findOrFail($id);
        $mengabsen->status = $validasi['status'];
        $mengabsen->jam_absen = now('Asia/Jakarta')->format('H:i:s'); // gunakan timezone Asia/Jakarta
        $mengabsen->save();

        $siswa = Siswa::findOrFail($mengabsen->id_siswa);
        $siswa->status = $validasi['status'];
        $siswa->save();

        return redirect(route('absen.index'))->with('success', 'Status siswa berhasil diperbarui.');
    }

    public function indexWalikelas(Request $request)
    {
        $query = Mengabsen::with(['siswa', 'guru']);

        if ($request->has('kelas') && $request->kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_local', $request->kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal_absen', $request->tanggal_absen);
        }

        $dataabsen = $query->get();
        $locals = Local::all();

        return view('guru.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'dataabsen' => $dataabsen,
            'locals' => $locals
        ]);
    }

    public function createWalikelas(Request $request)
    {
        $query = Siswa::with('local');

        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('id_local', $request->kelas);
        }

        $datasiswa = $query->get();
        $locals = Local::all();

        return view('guru.absen.create', [
            'menu' => 'absen',
            'title' => 'Absen Siswa',
            'datasiswa' => $datasiswa,
            'locals' => $locals
        ]);
    }

    public function membuat(Request $request)
    {
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'in:hadir,izin,sakit,alpa',
        ]);

        $statuses = $request->input('status', []);
        $currentDate = now('Asia/Jakarta')->toDateString();
        $currentTime = now('Asia/Jakarta')->format('H:i:s');
        $guru = Guru::where('id_user', Auth::id())->first();

        foreach ($statuses as $id => $status) {
            $siswa = Siswa::findOrFail($id);

            $siswa->status = $status;
            $siswa->save();

            Mengabsen::create([
                'tanggal_absen' => $currentDate,
                'jam_absen' => $currentTime,
                'status' => $status,
                'id_guru' => $guru->id,
                'id_siswa' => $id,
            ]);
        }

return redirect(route('absen.index'))->with('success', 'Status siswa berhasil diperbarui.');    }

    public function editWalikelas($id)
    {
        $mengabsen = Mengabsen::with('siswa.local')->findOrFail($id);
        return view('guru.absen.ubah', [
            'menu' => 'absen',
            'title' => 'Edit Absen',
            'mengabsen' => $mengabsen
        ]);
    }

    public function updateWalikelas(Request $request, $id)
    {
        $validasi = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'Status harus diisi',
        ]);

        $mengabsen = Mengabsen::findOrFail($id);
        $mengabsen->status = $validasi['status'];
        $mengabsen->jam_absen = now('Asia/Jakarta')->format('H:i:s'); // gunakan timezone Asia/Jakarta
        $mengabsen->save();

        $siswa = Siswa::findOrFail($mengabsen->id_siswa);
        $siswa->status = $validasi['status'];
        $siswa->save();

return redirect(route('absen.index'))->with('success', 'Status siswa berhasil diperbarui.');    }

    public function indexSiswa(Request $request)
    {
        $query = Mengabsen::with(['siswa', 'guru']);

        if ($request->has('kelas') && $request->kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_local', $request->kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal_absen', $request->tanggal_absen);
        }

        $dataabsen = $query->get();
        $locals = local::all();

        return view('admin.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'dataabsen' => $dataabsen,
            'locals' => $locals
        ]);
    }
}