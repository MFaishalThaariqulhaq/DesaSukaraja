<?php

namespace App\Services;

use App\Models\Sotk;
use Illuminate\Support\Collection;

class SotkService
{
    public function getAllWithColors(): Collection
    {
        return Sotk::orderBy('jabatan')
            ->get()
            ->map(function (Sotk $sotk) {
                $sotk->colors = [
                    'badgeBg' => $sotk->badge_color,
                    'iconColor' => $sotk->icon_color,
                    'icon' => $sotk->icon_name,
                ];

                return $sotk;
            });
    }

    public function getStructureData(): array
    {
        $sotks = Sotk::orderBy('jabatan')->get();
        $kepalaDesa = $sotks->whereIn('jabatan', ['Kepala Desa', 'Kades'])->first();
        $sekdes = $sotks->whereIn('jabatan', ['Sekretaris Desa', 'Sekdes'])->first();
        $level3 = $sotks->filter(
            fn (Sotk $item) => str_contains($item->jabatan, 'Kaur') || str_contains($item->jabatan, 'Kasi')
        );

        $staffData = $sotks->mapWithKeys(function (Sotk $sotk) {
            return [
                $sotk->id => [
                    'name' => $sotk->nama,
                    'role' => $sotk->jabatan,
                    'tupoksi' => $sotk->tupoksi ?? 'Tupoksi tidak tersedia',
                ],
            ];
        })->toArray();

        return compact('sotks', 'kepalaDesa', 'sekdes', 'level3', 'staffData');
    }
}
