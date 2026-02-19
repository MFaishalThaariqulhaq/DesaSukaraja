<?php

namespace App\Services\Admin;

use App\Models\Sotk;
use Illuminate\Support\Facades\Storage;

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

        if (!empty($validatedData['remove_foto']) && $sotk->foto && Storage::disk('public')->exists($sotk->foto)) {
            Storage::disk('public')->delete($sotk->foto);
            $data['foto'] = null;
        }

        if (!empty($validatedData['foto'])) {
            if ($sotk->foto && Storage::disk('public')->exists($sotk->foto)) {
                Storage::disk('public')->delete($sotk->foto);
            }
            $data['foto'] = $validatedData['foto']->store('sotk_foto', 'public');
        }

        $sotk->update($data);
    }

    public function delete(Sotk $sotk): void
    {
        if ($sotk->foto && Storage::disk('public')->exists($sotk->foto)) {
            Storage::disk('public')->delete($sotk->foto);
        }

        $sotk->delete();
    }

    public function uploadBagan(array $validatedData): string
    {
        $existing = Sotk::where('jabatan', 'Bagan')->first();
        $shouldRemove = (bool)($validatedData['remove_bagan'] ?? false);

        if ($shouldRemove && empty($validatedData['bagan'])) {
            if ($existing?->foto && Storage::disk('public')->exists($existing->foto)) {
                Storage::disk('public')->delete($existing->foto);
            }
            if ($existing) {
                $existing->delete();
            }

            return 'removed';
        }

        if (empty($validatedData['bagan'])) {
            return 'unchanged';
        }

        if ($existing?->foto && Storage::disk('public')->exists($existing->foto)) {
            Storage::disk('public')->delete($existing->foto);
        }

        $baganPath = $validatedData['bagan']->store('sotk_bagan', 'public');

        Sotk::updateOrCreate(
            ['jabatan' => 'Bagan'],
            ['foto' => $baganPath, 'nama' => 'Bagan Struktur Organisasi']
        );

        return 'updated';
    }
}
