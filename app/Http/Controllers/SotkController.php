<?php

namespace App\Http\Controllers;

use App\Models\Sotk;

class SotkController extends Controller
{
  public function index()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    return view('public.sotk.sotk', compact('sotks'));
  }
}
