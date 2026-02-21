<?php

namespace App\Http\Requests\Admin\Infografis;

use Illuminate\Foundation\Http\FormRequest;

class StoreInfografisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dusun' => ['required', 'string'],
            'total_penduduk' => ['required', 'integer', 'min:0'],
            'laki_laki' => ['required', 'integer', 'min:0'],
            'perempuan' => ['required', 'integer', 'min:0'],
            'kepala_keluarga' => ['required', 'integer', 'min:0'],
            'wajib_ktp' => ['nullable', 'integer', 'min:0'],
            'lahir' => ['nullable', 'integer', 'min:0'],
            'datang' => ['nullable', 'integer', 'min:0'],
            'mati' => ['nullable', 'integer', 'min:0'],
            'pindah' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_0_5' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_6_11' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_12_17' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_18_25' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_26_35' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_36_45' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_46_60' => ['nullable', 'integer', 'min:0'],
            'kelompok_usia_61_keatas' => ['nullable', 'integer', 'min:0'],
            'pendidikan_sd' => ['nullable', 'integer', 'min:0'],
            'pendidikan_smp' => ['nullable', 'integer', 'min:0'],
            'pendidikan_sma' => ['nullable', 'integer', 'min:0'],
            'pendidikan_diploma' => ['nullable', 'integer', 'min:0'],
            'pendidikan_belum' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_petani' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_wiraswasta' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_karyawan' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_pns' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_ibu_rumah_tangga' => ['nullable', 'integer', 'min:0'],
            'pekerjaan_belum' => ['nullable', 'integer', 'min:0'],
            'agama_islam' => ['nullable', 'integer', 'min:0'],
            'agama_kristen' => ['nullable', 'integer', 'min:0'],
            'agama_katolik' => ['nullable', 'integer', 'min:0'],
            'agama_hindu' => ['nullable', 'integer', 'min:0'],
            'agama_buddha' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

