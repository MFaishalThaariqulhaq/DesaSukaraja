<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Infografis\StoreInfografisRequest;
use App\Http\Requests\Admin\Infografis\UpdateInfografisRequest;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Services\Admin\InfografisService;

class InfografisController extends Controller
{
  public function __construct(private readonly InfografisService $infografisService)
  {
  }

  public function index()
  {
    $penduduks = $this->infografisService->paginate(10);
    return view('admin.infografis.index', compact('penduduks'));
  }

  public function create()
  {
    return view('admin.infografis.create');
  }

  public function store(StoreInfografisRequest $request)
  {
    $this->infografisService->create($request->validated());
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil ditambahkan.');
  }

  public function edit(Penduduk $penduduk)
  {
    return view('admin.infografis.edit', compact('penduduk'));
  }

  public function update(UpdateInfografisRequest $request, Penduduk $penduduk)
  {
    $this->infografisService->update($penduduk, $request->validated());
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil diupdate.');
  }

  public function destroy(Penduduk $penduduk)
  {
    $this->infografisService->delete($penduduk);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil dihapus.');
  }
}
