<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Penduduk per Dusun - Data 2025
        $dusunData = [
            [
                'dusun' => 'Dusun Sukaraja',
                'total_penduduk' => 1247,
                'laki_laki' => 638,
                'perempuan' => 609,
                'kepala_keluarga' => 324,
                'jumlah_kk' => 324,
            ],
            [
                'dusun' => 'Dusun Rawamerta',
                'total_penduduk' => 892,
                'laki_laki' => 456,
                'perempuan' => 436,
                'kepala_keluarga' => 231,
                'jumlah_kk' => 231,
            ],
            [
                'dusun' => 'Dusun Ciheuleut',
                'total_penduduk' => 756,
                'laki_laki' => 387,
                'perempuan' => 369,
                'kepala_keluarga' => 197,
                'jumlah_kk' => 197,
            ],
            [
                'dusun' => 'Dusun Kertapura',
                'total_penduduk' => 645,
                'laki_laki' => 330,
                'perempuan' => 315,
                'kepala_keluarga' => 172,
                'jumlah_kk' => 172,
            ],
            [
                'dusun' => 'Dusun Pasir',
                'total_penduduk' => 543,
                'laki_laki' => 278,
                'perempuan' => 265,
                'kepala_keluarga' => 145,
                'jumlah_kk' => 145,
            ],
        ];

        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        foreach ($dusunData as $data) {
            Penduduk::create(array_merge($data, [
                'bulan' => $bulanSekarang,
                'tahun' => $tahunSekarang,
                'wajib_ktp' => intval($data['total_penduduk'] * 0.65), // Asumsi 65% wajib KTP
                'sudah_kk' => intval($data['kepala_keluarga'] * 0.95), // 95% sudah punya KK
                'belum_kk' => intval($data['kepala_keluarga'] * 0.05),
                'sudah_ktp' => intval($data['total_penduduk'] * 0.88), // 88% sudah KTP
                'belum_ktp' => intval($data['total_penduduk'] * 0.12),
                'wni' => intval($data['total_penduduk'] * 0.99), // 99% WNI
                'wna' => intval($data['total_penduduk'] * 0.01),
                'lahir' => 12,
                'datang' => 3,
                'mati' => 2,
                'pindah' => 5,
            ]));
        }
    }
}
