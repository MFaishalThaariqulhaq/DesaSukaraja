<?php

namespace App\Http\Controllers;

use App\Models\Sotk;

class SotkController extends Controller
{
  /**
   * Color configuration for each jabatan (position)
   */
  private function getColorMap()
  {
    return [
      'Kepala Desa' => [
        'badgeBg' => '#10b981', 
        'overlayBg' => 'rgba(5, 55, 50, 0.95)',
        'icon' => 'book-open',
        'iconColor' => '#6ee7b7'
      ],
      'Sekretaris Desa' => [
        'badgeBg' => '#2563eb', 
        'overlayBg' => 'rgba(30, 58, 138, 0.95)',
        'icon' => 'file-text',
        'iconColor' => '#93c5fd'
      ],
      'Kaur Umum & TU' => [
        'badgeBg' => '#f59e0b', 
        'overlayBg' => 'rgba(78, 22, 9, 0.95)',
        'icon' => 'archive',
        'iconColor' => '#fcd34d'
      ],
      'Kaur Keuangan' => [
        'badgeBg' => '#f59e0b', 
        'overlayBg' => 'rgba(78, 22, 9, 0.95)',
        'icon' => 'coins',
        'iconColor' => '#fcd34d'
      ],
      'Kaur Perencanaan' => [
        'badgeBg' => '#f59e0b', 
        'overlayBg' => 'rgba(78, 22, 9, 0.95)',
        'icon' => 'clipboard-list',
        'iconColor' => '#fcd34d'
      ],
      'Kasi Pemerintahan' => [
        'badgeBg' => '#9333ea', 
        'overlayBg' => 'rgba(55, 48, 163, 0.95)',
        'icon' => 'landmark',
        'iconColor' => '#d8b4fe'
      ],
      'Kasi Pelayanan' => [
        'badgeBg' => '#9333ea', 
        'overlayBg' => 'rgba(55, 48, 163, 0.95)',
        'icon' => 'user-check',
        'iconColor' => '#d8b4fe'
      ],
      'Kasi Kesra' => [
        'badgeBg' => '#9333ea', 
        'overlayBg' => 'rgba(55, 48, 163, 0.95)',
        'icon' => 'heart-handshake',
        'iconColor' => '#d8b4fe'
      ],
    ];
  }

  /**
   * Get color for a specific jabatan
   */
  private function getColorForJabatan($jabatan)
  {
    $colorMap = $this->getColorMap();
    
    return $colorMap[$jabatan] ?? [
      'badgeBg' => '#ec4899',
      'overlayBg' => 'rgba(88, 28, 135, 0.95)',
      'icon' => 'map',
      'iconColor' => '#f472b6'
    ];
  }

  public function index()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    
    // Add color data to each sotk record
    $sotks = $sotks->map(function ($sotk) {
      $sotk->colors = $this->getColorForJabatan($sotk->jabatan);
      return $sotk;
    });

    return view('public.sotk.sotk', compact('sotks'));
  }

  public function detail()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    
    // Add color data to each sotk record
    $sotks = $sotks->map(function ($sotk) {
      $sotk->colors = $this->getColorForJabatan($sotk->jabatan);
      return $sotk;
    });

    return view('public.sotk.detail', compact('sotks'));
  }
}
