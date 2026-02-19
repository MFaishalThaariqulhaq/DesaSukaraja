<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sotk\StoreSotkRequest;
use App\Http\Requests\Admin\Sotk\UpdateSotkRequest;
use App\Http\Requests\Admin\Sotk\UploadBaganRequest;
use App\Models\Sotk;
use App\Services\Admin\SotkService;
use Illuminate\Http\Request;

class SotkController extends Controller
{
  public function __construct(private readonly SotkService $sotkService)
  {
  }

  public function index(Request $request)
  {
    $allowedPerPage = [5, 10, 15];
    $perPage = (int) $request->query('per_page', 10);
    if (!in_array($perPage, $allowedPerPage, true)) {
      $perPage = 10;
    }

    $sotks = Sotk::orderBy('jabatan')->paginate($perPage)->withQueryString();
    return view('admin.sotk.index', compact('sotks', 'perPage'));
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
    $this->sotkService->delete($sotk);
    return redirect()->route('admin.sotk.index')->with('success', 'SOTK berhasil dihapus');
  }
  // Form upload bagan organisasi
  public function baganForm()
  {
    $bagan = Sotk::where('jabatan', 'Bagan')->first();
    return view('admin.sotk.bagan', compact('bagan'));
  }

  // Proses upload bagan organisasi
  public function baganUpload(UploadBaganRequest $request)
  {
    $result = $this->sotkService->uploadBagan($request->validated());

    $message = match ($result) {
      'removed' => 'Bagan organisasi berhasil dihapus.',
      'updated' => 'Bagan organisasi berhasil diperbarui.',
      default => 'Tidak ada perubahan pada bagan organisasi.',
    };

    return redirect()->route('admin.sotk.bagan')->with('success', $message);
  }
}
