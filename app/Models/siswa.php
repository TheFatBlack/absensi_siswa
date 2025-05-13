<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siswa extends Authenticatable

{
    use HasFactory;
    protected $table = 'siswas';

    protected $fillable = ['nama', 'nisn', 'alamat', 'jk',  'nohp', 'username', 'password', 'nohp_wm', 'nama_wm', 'alamat_wm','status', 'id_local', 'id_user'];


    public function local()
    {
        return $this->belongsTo(local::class, 'id_local');
    }
    
    public function siswaCollection()
    {
        return $this->hasMany(siswa::class, 'id_user');
    }
    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function mengabsen()
    {
        return $this->hasMany(Mengabsen::class, 'id_siswa');
    }
}