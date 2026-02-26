<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function profil()
  {
    $profil = \App\Models\ProfilDesa::first();
    $sejarah = $profil ? $profil->sejarah()->orderBy('tahun', 'asc')->get() : collect();
    return view('public.profil.profil', compact('profil', 'sejarah'));
  }

  public function beritaIndex(Request $request)
  {
    $query = \App\Models\Berita::orderBy('created_at', 'desc');

    // Check jika parameter kategori ada dan tidak kosong
    if ($request->filled('kategori')) {
      $kategori = trim($request->kategori);
      // Case-insensitive search dengan trim di sisi database untuk kategori yang punya spasi tersembunyi
      $query->whereRaw('LOWER(TRIM(kategori)) = LOWER(?)', [$kategori]);
    }

    $beritas = $query->get();
    return view('public.berita.index', compact('beritas'));
  }
  public function index()
  {
    $beritas = \App\Models\Berita::orderBy('created_at', 'desc')->take(3)->get();
    $galeris = \App\Models\Galeri::orderBy('created_at', 'desc')->take(6)->get();

    $sotks = \App\Models\Sotk::orderBy('created_at', 'asc')->get();
    $pengaduanCount = \App\Models\Pengaduan::count();
    $profil = \App\Models\ProfilDesa::first();

    // Statistik penduduk dihitung di database agar query lebih ringan.
    $stat = \App\Models\Penduduk::query()
      ->selectRaw('COALESCE(SUM(total_penduduk), 0) as total_penduduk')
      ->selectRaw('COALESCE(SUM(kepala_keluarga), 0) as total_kk')
      ->selectRaw('COALESCE(SUM(laki_laki), 0) as total_laki')
      ->selectRaw('COALESCE(SUM(perempuan), 0) as total_perempuan')
      ->first();

    $stat_penduduk = [
      'total_penduduk' => (int) ($stat->total_penduduk ?? 0),
      'total_kk' => (int) ($stat->total_kk ?? 0),
      'total_laki' => (int) ($stat->total_laki ?? 0),
      'total_perempuan' => (int) ($stat->total_perempuan ?? 0),
    ];
    return view('public.beranda', compact('beritas', 'galeris', 'sotks', 'pengaduanCount', 'profil', 'stat_penduduk'));
  }

  public function beritaDetail($slug)
  {
    $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
    // Berita terkait: 5 berita terbaru selain yang sedang dibaca
    $beritaTerkait = \App\Models\Berita::where('id', '!=', $berita->id)
      ->orderBy('created_at', 'desc')
      ->take(5)
      ->get();
    // Berita lainnya: 2 berita setelah berita terkait
    $beritaLainnya = \App\Models\Berita::where('id', '!=', $berita->id)
      ->orderBy('created_at', 'desc')
      ->skip(5)
      ->take(2)
      ->get();
    return view('public.berita.detail', compact('berita', 'beritaTerkait', 'beritaLainnya'));
  }

  public function profilSejarah()
  {
    $profil = \App\Models\ProfilDesa::first();
    return view('public.profil.sejarah', compact('profil'));
  }

  public function profilVisiMisi()
  {
    $profil = \App\Models\ProfilDesa::first();
    return view('public.profil.visimisi', compact('profil'));
  }
}
