<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\local;
use App\Models\siswa;
use Illuminate\Http\Request;

class siswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datasiswa = Siswa::all();
        return view('admin.siswa.index', [
            'menu' => 'siswa',
            'title' => 'Data Siswa',
            'datasiswa' => $datasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = local::all();
        return view('admin.siswa.create', [
            'menu' => 'siswa',
            'title' => 'Tambah Data Siswa',
            'kelas' => $kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'nohp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'nohp_wm' => 'required',
            'nama_wm' => 'required',
            'alamat_wm' => 'required',
            'id_local' => 'required',
            'id_user' => 'nullable',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'nisn.required' => 'NISN Harus Diisi',
            'alamat.required' => 'Alamat Harus Diisi',
            'jk.required' => 'Jenis Kelamin Harus Diisi',
            'nohp.required' => 'No HP murid Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'nohp_wm.required' => 'No HP WaliMurid Harus Diisi',
            'nama_wm.required' => 'Nama WaliMurid Harus Diisi',
            'alamat_wm.required' => 'Alamat WaliMurid Harus Diisi',
            'id_local.required' => 'Kelas Harus Diisi',
        ]);

        $user = new User();
        $user->username = $validasi['username'];
        $user->password = bcrypt($validasi['password']);
        $user->level = 'siswa'; // Default level siswa
        $user->save();
        
        $siswa  = new siswa;
        $siswa->nama = $validasi['nama'];
        $siswa->nisn = $validasi['nisn'];
        $siswa->alamat = $validasi['alamat'];
        $siswa->jk = $validasi['jk'];
        $siswa->nohp = $validasi['nohp'];
        $siswa->username = $validasi['username'];
        $siswa->password = bcrypt($validasi['password']);
        $siswa->nohp_wm = $validasi['nohp_wm'];
        $siswa->nama_wm = $validasi['nama_wm'];
        $siswa->alamat_wm = $validasi['alamat_wm'];
        $siswa->id_local = $validasi['id_local'];
        $siswa->id_user = $user->id;
        $siswa->save();
        return redirect(route('siswa.index'));
    }

        public function show($id)
    {
        $siswa = siswa::find($id);
        return view('admin.siswa.view', [
            'menu' => 'siswa',
            'title' => 'Detail Data Siswa',
            'siswa' => $siswa
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $siswa = siswa::with('local')->find($id);
        $kelas = local::all();
        return view('admin.siswa.edit', [
            'menu' => 'siswa',
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'nullable',
            'nisn' => 'nullable',
            'alamat' => 'nullable',
            'jk' => 'nullable',
            'nohp' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'nohp_wm' => 'nullable',
            'nama_wm' => 'nullable',
            'alamat_wm' => 'nullable',
            'id_local' => 'nullable',
            'id_user' => 'nullable',
        ]);

        $siswa = Siswa::findOrFail($id);

        // Update data siswa
        $siswa->nama = $validasi['nama'] ?? $siswa->nama;
        $siswa->nisn = $validasi['nisn'] ?? $siswa->nisn;
        $siswa->alamat = $validasi['alamat'] ?? $siswa->alamat;
        $siswa->jk = $validasi['jk'] ?? $siswa->jk;
        $siswa->nohp = $validasi['nohp'] ?? $siswa->nohp;
        $siswa->username = $validasi['username'] ?? $siswa->username;
        if ($request->filled('password')) {
            $siswa->password = bcrypt($validasi['password']);
        }
        $siswa->nohp_wm = $validasi['nohp_wm'] ?? $siswa->nohp_wm;
        $siswa->nama_wm = $validasi['nama_wm'] ?? $siswa->nama_wm;
        $siswa->alamat_wm = $validasi['alamat_wm'] ?? $siswa->alamat_wm;
        $siswa->id_local = $validasi['id_local'] ?? $siswa->id_local;

        $siswa->save();

       $user = User::findOrFail($siswa->id_user);
        $user->username = $validasi['username'] ?? $user->username;
        if ($request->filled('password')) {
            $user->password = bcrypt($validasi['password']);
        }

        $user->save();

        return redirect(route('siswa.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = siswa::find($id);
        $siswa->delete();
        return redirect(route('siswa.index'));
    }
}