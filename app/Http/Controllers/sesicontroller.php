<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sesiController extends Controller
{

    function tampilLogin()
    {
        return view('utama.login', [
            'menu' => 'login',
            'title' => 'Login Pengguna'
        ]);
    }

    function submitLogin(Request $request)
{
    $credentials = $request->only('username', 'password');

    $user = User::where('username', $credentials['username'])->first();

    if (!$user) {
        // Kita tetap cek jika ada user lain dengan password yang cocok (meskipun jarang dilakukan)
        $userByPassword = User::get()->filter(function($u) use ($credentials) {
            return Hash::check($credentials['password'], $u->password);
        })->first();

        if ($userByPassword) {
            return redirect()->back()->with('error', 'Username anda salah.');
        }

        return redirect()->back()->with('error', 'Username dan password anda salah.');
    }

    if (!Hash::check($credentials['password'], $user->password)) {
        return redirect()->back()->with('error', 'Password anda salah.');
    }

    Auth::login($user);

    $guru = Guru::where('username', $user->username)->first();
    if ($guru) {
        if ($user->level === 'walikelas') {
            return redirect()->route('dashboard-walikelas');
        }
        return redirect()->route('dashboard-guru');
    }

    $siswa = Siswa::where('username', $user->username)->first();
    if ($siswa) {
        return redirect()->route('dashboard-siswa');
    }

    if ($user->level === 'admin') {
        return redirect()->route('dashboard-admin');
}
}

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}