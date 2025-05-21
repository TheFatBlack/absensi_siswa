<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Mengabsen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    protected $kelas;

    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }

    public function collection()
    {
        $siswaKelas = Siswa::where('id_local', $this->kelas)->get();
        $rekapAbsensi = Mengabsen::whereIn('id_siswa', $siswaKelas->pluck('id'))->with('siswa')->get();

        return $rekapAbsensi->map(function ($absen) {
            return [
                'Nama Siswa' => $absen->siswa->nama ?? '',
                'Tanggal' => $absen->tanggal_absen ?? '',
                'Status' => $absen->status ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Tanggal',
            'Status',
        ];
    }
}