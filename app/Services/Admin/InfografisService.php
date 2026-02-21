<?php

namespace App\Services\Admin;

use App\Models\Penduduk;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InfografisService
{
    private const NULLABLE_NUMERIC_FIELDS = [
        'wajib_ktp',
        'lahir',
        'datang',
        'mati',
        'pindah',
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

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Penduduk::query()
            ->orderBy('dusun')
            ->paginate($perPage);
    }

    public function create(array $validated): Penduduk
    {
        return Penduduk::create($this->normalizeNullableNumericFields($validated));
    }

    public function update(Penduduk $penduduk, array $validated): bool
    {
        return $penduduk->update($this->normalizeNullableNumericFields($validated));
    }

    public function delete(Penduduk $penduduk): bool
    {
        return (bool) $penduduk->delete();
    }

    private function normalizeNullableNumericFields(array $data): array
    {
        foreach (self::NULLABLE_NUMERIC_FIELDS as $field) {
            if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
                $data[$field] = 0;
            }
        }

        return $data;
    }
}

