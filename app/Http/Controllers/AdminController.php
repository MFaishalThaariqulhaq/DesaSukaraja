<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengaduan;
use App\Models\Sotk;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function dashboard()
  {
    $startWindow = Carbon::now()->startOfMonth()->subMonths(5);

    $monthKeys = [];
    $monthLabels = [];
    for ($i = 5; $i >= 0; $i--) {
      $date = Carbon::now()->startOfMonth()->subMonths($i);
      $monthKeys[] = $date->format('Y-m');
      $monthLabels[] = $date->translatedFormat('M Y');
    }

    $beritaPerMonthMap = Berita::where('created_at', '>=', $startWindow)
      ->get()
      ->groupBy(fn($item) => $item->created_at->format('Y-m'))
      ->map(fn($group) => $group->count());

    $pengaduanPerMonthMap = Pengaduan::where('created_at', '>=', $startWindow)
      ->get()
      ->groupBy(fn($item) => $item->created_at->format('Y-m'))
      ->map(fn($group) => $group->count());

    $beritaPerMonth = array_map(fn($key) => (int) ($beritaPerMonthMap[$key] ?? 0), $monthKeys);
    $pengaduanPerMonth = array_map(fn($key) => (int) ($pengaduanPerMonthMap[$key] ?? 0), $monthKeys);

    $pengaduanByCategoryMap = Pengaduan::select('kategori')
      ->get()
      ->groupBy(fn($item) => $item->kategori ?: 'Tanpa Kategori')
      ->map(fn($group) => $group->count())
      ->sortDesc();

    $categoryLabels = $pengaduanByCategoryMap->keys()->values()->toArray();
    $categoryCounts = $pengaduanByCategoryMap->values()->map(fn($val) => (int) $val)->toArray();

    $stats = [
      'berita_total' => Berita::count(),
      'galeri_total' => Galeri::count(),
      'sotk_total' => Sotk::where('jabatan', '!=', 'Bagan')->count(),
      'pengaduan_total' => Pengaduan::count(),
      'pengaduan_submitted' => Pengaduan::where('status', 'submitted')->count(),
      'pengaduan_in_progress' => Pengaduan::where('status', 'in_progress')->count(),
      'pengaduan_resolved' => Pengaduan::where('status', 'resolved')->count(),
      'pengaduan_rejected' => Pengaduan::where('status', 'rejected')->count(),
    ];

    $recentPengaduans = Pengaduan::latest()->take(5)->get();
    $recentBeritas = Berita::latest()->take(5)->get();
    $recentGaleris = Galeri::latest()->take(5)->get();

    $chartData = [
      'month_labels' => $monthLabels,
      'berita_per_month' => $beritaPerMonth,
      'pengaduan_per_month' => $pengaduanPerMonth,
      'category_labels' => $categoryLabels,
      'category_counts' => $categoryCounts,
    ];

    return view('admin.home', compact('stats', 'chartData', 'recentPengaduans', 'recentBeritas', 'recentGaleris'));
  }
}
