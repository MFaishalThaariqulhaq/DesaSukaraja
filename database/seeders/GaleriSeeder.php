<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeris = [
            [
                'judul' => 'Upacara Adat Panen Raya',
                'deskripsi' => 'Upacara adat panen raya yang dirayakan dengan meriah oleh seluruh masyarakat Desa Sukaraja.',
                'kategori' => 'Kegiatan',
                'gambar' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Hamparan Sawah Blok C',
                'deskripsi' => 'Pemandangan indah hamparan sawah yang luas di Blok C Desa Sukaraja.',
                'kategori' => 'Alam & Wisata',
                'gambar' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad576?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Pengaspalan Jalan Dusun 2',
                'deskripsi' => 'Proyek pembangunan infrastruktur jalan di Dusun 2 yang telah selesai dengan hasil yang memuaskan.',
                'kategori' => 'Pembangunan',
                'gambar' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Keceriaan Anak-Anak Desa',
                'deskripsi' => 'Aktivitas anak-anak desa yang penuh keceriaan dan energi positif.',
                'kategori' => 'Kegiatan',
                'gambar' => 'https://images.unsplash.com/photo-1503454537688-e6a8da0aa343?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Sungai Citarum Asri',
                'deskripsi' => 'Keindahan alami Sungai Citarum yang mengalir melalui Desa Sukaraja.',
                'kategori' => 'Alam & Wisata',
                'gambar' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Pameran Produk Lokal',
                'deskripsi' => 'Pameran produk lokal UMKM dari Desa Sukaraja yang menampilkan keragaman produk berkualitas.',
                'kategori' => 'Kegiatan',
                'gambar' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Penyaluran Bantuan Sosial',
                'deskripsi' => 'Program penyaluran bantuan sosial kepada masyarakat yang membutuhkan.',
                'kategori' => 'Kegiatan',
                'gambar' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'judul' => 'Posyandu Desa',
                'deskripsi' => 'Kegiatan Posyandu untuk monitoring kesehatan ibu dan anak di desa.',
                'kategori' => 'Pembangunan',
                'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?q=80&w=800&auto=format&fit=crop',
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}
