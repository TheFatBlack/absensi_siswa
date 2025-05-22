<?php
// filepath: /c:/xampp/htdocs/absensi-siswa/app/Models/Guru.php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Guru extends Authenticatable
{
    protected $fillable = [
        'nama',
        'nip',
        'nohp',
        'jk',
        'tanggal_lahir',
        'username',
        'password',
        'id_user'
    ];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}