<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sotk\StoreSotkRequest;
use App\Http\Requests\Admin\Sotk\UpdateSotkRequest;
use App\Http\Requests\Admin\Sotk\UploadBaganRequest;
use App\Models\Sotk;
use App\Services\Admin\SotkService;

class SotkController extends Controller
{
  public function __construct(private readonly SotkService $sotkService)
  {
  }

  public function index()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    return view('admin.sotk.index', compact('sotks'));
  }
  public function create()
  {
    return view('admin.sotk.create');
  }
  public function store(StoreSotkRequest $request)
  {
    $this->sotkService->create($request->validated());

    return redirect()->route('admin.sotk.index')->with('success', 'SOTK berhasil ditambahkan');
  }
  public function edit($id)
  {
    $sotk = Sotk::findOrFail($id);
    return view('admin.sotk.edit', compact('sotk'));
  }
  public function update(UpdateSotkRequest $request, $id)
  {
    $sotk = Sotk::findOrFail($id);
    $this->sotkService->update($sotk, $request->validated());

    return redirect()->route('admin.sotk.index')->with('success', 'SOTK berhasil diupdate');
  }
  public function destroy($id)
  {
    $sotk = Sotk::findOrFail($id);
    $sotk->delete();
    return redirect()->route('admin.sotk.index')->with('success', 'SOTK berhasil dihapus');
  }
  // Form upload bagan organisasi
  public function baganForm()
  {
    return view('admin.sotk.bagan');
  }

  // Proses upload bagan organisasi
  public function baganUpload(UploadBaganRequest $request)
  {
    $this->sotkService->uploadBagan($request->validated());

    return redirect()->route('admin.sotk.index')->with('success', 'Bagan organisasi berhasil diupload');
  }
}
