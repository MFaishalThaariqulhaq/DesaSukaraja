<?php

namespace App\Services\Admin;

use App\Models\Sotk;

class SotkService
{
    public function create(array $validatedData): Sotk
    {
        $data = $validatedData;

        if (!empty($validatedData['foto'])) {
            $data['foto'] = $validatedData['foto']->store('sotk_foto', 'public');
        }

        return Sotk::create($data);
    }

    public function update(Sotk $sotk, array $validatedData): void
    {
        $data = $validatedData;

        if (!empty($validatedData['foto'])) {
            $data['foto'] = $validatedData['foto']->store('sotk_foto', 'public');
        }

        $sotk->update($data);
    }

    public function uploadBagan(array $validatedData): void
    {
        $baganPath = $validatedData['bagan']->store('sotk_bagan', 'public');

        Sotk::updateOrCreate(
            ['jabatan' => 'Bagan'],
            ['foto' => $baganPath, 'nama' => 'Bagan Struktur Organisasi']
        );
    }
}
