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

    if ($request->has('kategori') && !empty(trim($request->kategori))) {
      $kategori = trim($request->kategori);
      // Case-insensitive search
      $query->whereRaw('LOWER(kategori) = LOWER(?)', [$kategori]);
    }

    // Get all beritas untuk JavaScript pagination
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
    // Statistik penduduk
    $penduduks = \App\Models\Penduduk::all();
    $stat_penduduk = [
      'total_penduduk' => $penduduks->sum('total_penduduk'),
      'total_kk' => $penduduks->sum('kepala_keluarga'),
      'total_laki' => $penduduks->sum('laki_laki'),
      'total_perempuan' => $penduduks->sum('perempuan'),
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
