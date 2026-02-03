<?php

namespace App\Http\Controllers;

use App\Models\Sotk;

class SotkController extends Controller
{
  public function index()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    
    // Add colors attribute dari database
    $sotks = $sotks->map(function ($sotk) {
      $sotk->colors = [
        'badgeBg' => $sotk->badge_color,
        'iconColor' => $sotk->icon_color,
        'icon' => $sotk->icon_name,
      ];
      return $sotk;
    });

    return view('public.sotk.sotk', compact('sotks'));
  }

  public function detail()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    
    // Add colors attribute dari database
    $sotks = $sotks->map(function ($sotk) {
      $sotk->colors = [
        'badgeBg' => $sotk->badge_color,
        'iconColor' => $sotk->icon_color,
        'icon' => $sotk->icon_name,
      ];
      return $sotk;
    });

    return view('public.sotk.detail', compact('sotks'));
  }
}
