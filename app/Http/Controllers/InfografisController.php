<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;

class InfografisController extends Controller
{
  public function index()
  {
    // Ambil semua data penduduk per dusun, urutkan nama dusun
    $data = Penduduk::orderBy('dusun')->get();
    return view('public.infografis.index', compact('data'));
  }

  public function detail($dusun)
  {
    // Ambil data untuk dusun spesifik
    $data = Penduduk::where('dusun', $dusun)->first();
    
    if (!$data) {
      abort(404, 'Data dusun tidak ditemukan');
    }

    return view('public.infografis.detail', compact('data'));
  }
}

