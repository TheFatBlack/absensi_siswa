<?php

namespace App\Http\Controllers;

use App\Models\guru;

use App\Models\User;
use App\Models\local;
use App\Models\jurusan;
use Illuminate\Http\Request;

class localcontroller extends Controller
{
    public function index()
    {
        $local = Local::with('guru')->get(); // Mengambil data dengan relasi
        $jurusan = Jurusan::all();

        return view('admin.local.index', [
            'menu' => 'local',
            'title' => 'Data Kelas',
            'local' => $local,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();

        // Ambil ID wali kelas yang sudah digunakan
        $guru_terpakai = Local::pluck('id_guru')->toArray();

        return view('admin.local.create', [
            'menu' => 'local',
            'title' => 'Tambah Data Kelas',
            'jurusan' => $jurusan,
            'guru' => $guru,
            'guru_terpakai' => $guru_terpakai // Kirim data guru yang sudah dipakai
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required', // Angkatan (X, XI, XII, XIII)
            'id_jurusan' => 'required',
            'id_guru' => 'required'
        ], [
            'nama.required' => 'Angkatan harus dipilih',
            'id_jurusan.required' => 'Jurusan harus dipilih',
            'id_guru.required' => 'Wali kelas harus dipilih'
        ]);

        // Ambil nama jurusan berdasarkan id_jurusan
        $jurusan = Jurusan::find($validasi['id_jurusan']);

        if (!$jurusan) {
            return back()->withErrors(['id_jurusan' => 'Jurusan tidak ditemukan']);
        }

        // Gabungkan angkatan dengan nama jurusan (menggunakan huruf)
        $nama_kelas = $validasi['nama'] . ' ' . $jurusan->nama;

        // Simpan data ke database
        $local = new Local();
        $local->nama = $nama_kelas;
        $local->id_jurusan = $validasi['id_jurusan'];
        $local->id_guru = $validasi['id_guru'];
        $local->save();

        // Update level user menjadi walikelas
        $guru = Guru::find($validasi['id_guru']);
        if ($guru) {
            $user = User::find($guru->id_user);
            if ($user) {
                $user->level = 'walikelas';
                $user->save();
            }
        }

        return redirect(route('local.index'))->with('success', 'Data kelas berhasil ditambahkan dan level user diperbarui menjadi walikelas');
    }


    public function show($id)
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        $local = Local::find($id);

        // Ambil ID wali kelas yang sudah digunakan
        $guru_terpakai = Local::pluck('id_guru')->toArray();

        return view('admin.local.view', [
            'menu' => 'local',
            'title' => 'Tambah Data Kelas',
            'jurusan' => $jurusan,
            'guru' => $guru,
            'local' => $local,
            'guru_terpakai' => $guru_terpakai // Kirim data guru yang sudah dipakai
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $local = Local::with('jurusan', 'guru')->find($id);
        $gurus = Guru::all(); // Ambil semua guru
        $jurusan = Jurusan::all();
        $guru_terpakai = Local::pluck('id_guru')->toArray();

        return view('admin.local.edit', [
            'menu' => 'local',
            'title' => 'Edit Data Siswa',
            'local' => $local,
            'jurusan' => $jurusan,
            'guru' => $gurus, // Kirim variabel $gurus
            'guru_terpakai' => $guru_terpakai
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'required', // Angkatan (X, XI, XII, XIII)
            'id_jurusan' => 'required',
            'id_guru' => 'required'
        ], [
            'nama.required' => 'Angkatan harus dipilih',
            'id_jurusan.required' => 'Jurusan harus dipilih',
            'id_guru.required' => 'Wali kelas harus dipilih'
        ]);

        // Ambil data kelas berdasarkan id
        $local = Local::find($id);
        if (!$local) {
            return back()->withErrors(['error' => 'Data tidak ditemukan']);
        }

        // Ambil nama jurusan berdasarkan id_jurusan
        $jurusan = Jurusan::find($validasi['id_jurusan']);
        if (!$jurusan) {
            return back()->withErrors(['id_jurusan' => 'Jurusan tidak ditemukan']);
        }

        // Gabungkan angkatan dengan nama jurusan (menggunakan huruf)
        $nama_kelas = $validasi['nama'] . ' ' . $jurusan->nama;

        // Update data di database
        $local->nama = $nama_kelas;
        $local->id_jurusan = $validasi['id_jurusan'];
        $local->id_guru = $validasi['id_guru'];
        $local->save();

        return redirect(route('local.index'))->with('success', 'Data kelas berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $local = local::find($id);
        $local->delete();
        return redirect(route('local.index'));
    }   
}