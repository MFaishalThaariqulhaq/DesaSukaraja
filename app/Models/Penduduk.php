<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'dusun',
        'bulan',
        'tahun',
        'total_penduduk',
        'laki_laki',
        'perempuan',
        'kepala_keluarga',
        'jumlah_kk',
        'wajib_ktp',
        'sudah_kk',
        'belum_kk',
        'sudah_ktp',
        'belum_ktp',
        'lahir',
        'datang',
        'mati',
        'pindah',
        'penduduk_bulan_lalu',
        'penduduk_bulan_ini',
        'wni',
        'wna',
        'kelompok_usia_0_5',
        'kelompok_usia_6_11',
        'kelompok_usia_12_17',
        'kelompok_usia_18_25',
        'kelompok_usia_26_35',
        'kelompok_usia_36_45',
        'kelompok_usia_46_60',
        'kelompok_usia_61_keatas',
        'pendidikan_sd',
        'pendidikan_smp',
        'pendidikan_sma',
        'pendidikan_diploma',
        'pendidikan_belum',
        'pekerjaan_petani',
        'pekerjaan_wiraswasta',
        'pekerjaan_karyawan',
        'pekerjaan_pns',
        'pekerjaan_ibu_rumah_tangga',
        'pekerjaan_belum',
        'agama_islam',
        'agama_kristen',
        'agama_katolik',
        'agama_hindu',
        'agama_buddha',
    ];
}
