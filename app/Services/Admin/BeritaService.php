<?php

namespace App\Services\Admin;

use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaService
{
    public function create(array $validatedData): Berita
    {
        $data = $validatedData;
        $data['slug'] = Str::slug($validatedData['judul']);
        $data['gambar'] = $this->storeImage($validatedData);

        return Berita::create($data);
    }

    public function update(Berita $berita, array $validatedData): void
    {
        $data = $validatedData;
        $data['slug'] = Str::slug($validatedData['judul']);
        $data['gambar'] = $berita->gambar;

        if (!empty($validatedData['gambar'])) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $data['gambar'] = $validatedData['gambar']->store('berita', 'public');
        }

        $berita->update($data);
    }

    public function delete(Berita $berita): void
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
    }

    private function storeImage(array $validatedData): ?string
    {
        if (empty($validatedData['gambar'])) {
            return null;
        }

        return $validatedData['gambar']->store('berita', 'public');
    }
}
