<?php

namespace App\Http\Controllers;

use App\Services\SotkService;

class SotkController extends Controller
{
  public function __construct(private readonly SotkService $sotkService)
  {
  }

  public function index()
  {
    $sotks = $this->sotkService->getAllWithColors();

    return view('public.sotk.sotk', compact('sotks'));
  }

  public function detail()
  {
    $sotks = $this->sotkService->getAllWithColors();

    return view('public.sotk.detail', compact('sotks'));
  }

  public function struktur()
  {
    return view('public.sotk.struktur', $this->sotkService->getStructureData());
  }
}
