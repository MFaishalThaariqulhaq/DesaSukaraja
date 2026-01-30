<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
  public function index()
  {
    $galeris = Galeri::orderBy('created_at', 'desc')->get();
    return view('public.galeri.index', compact('galeris'));
  }
}
