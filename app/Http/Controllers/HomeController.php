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

  public function beritaIndex()
  {
    $beritas = \App\Models\Berita::orderBy('created_at', 'desc')->paginate(6);
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
    $beritaTerbaru = \App\Models\Berita::where('id', '!=', $berita->id)->orderBy('created_at', 'desc')->take(5)->get();
    return view('public.berita.detail', compact('berita', 'beritaTerbaru'));
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
