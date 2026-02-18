<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Berita\StoreBeritaRequest;
use App\Http\Requests\Admin\Berita\UpdateBeritaRequest;
use App\Models\Berita;
use App\Services\Admin\BeritaService;

class BeritaController extends Controller
{
  public function __construct(private readonly BeritaService $beritaService)
  {
  }

  public function index()
  {
    $beritas = Berita::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.berita.index', compact('beritas'));
  }

  public function create()
  {
    return view('admin.berita.create');
  }

  public function store(StoreBeritaRequest $request)
  {
    $this->beritaService->create($request->validated());

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
  }

  public function edit($id)
  {
    $berita = Berita::findOrFail($id);
    return view('admin.berita.edit', compact('berita'));
  }

  public function update(UpdateBeritaRequest $request, $id)
  {
    $berita = Berita::findOrFail($id);
    $this->beritaService->update($berita, $request->validated());

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
  }

  public function destroy($id)
  {
    $berita = Berita::findOrFail($id);
    $this->beritaService->delete($berita);

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
  }
}
