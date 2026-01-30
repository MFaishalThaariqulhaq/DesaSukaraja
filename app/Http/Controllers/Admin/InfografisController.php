<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Storage;

class InfografisController extends Controller
{
  public function index()
  {
    $penduduks = Penduduk::orderBy('dusun')->paginate(10);
    return view('admin.infografis.index', compact('penduduks'));
  }

  public function create()
  {
    return view('admin.infografis.create');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'dusun' => 'required|string',
      'total_penduduk' => 'required|integer|min:0',
      'laki_laki' => 'required|integer|min:0',
      'perempuan' => 'required|integer|min:0',
      'kepala_keluarga' => 'required|integer|min:0',
      'wajib_ktp' => 'nullable|integer|min:0',
      'lahir' => 'nullable|integer|min:0',
      'datang' => 'nullable|integer|min:0',
      'mati' => 'nullable|integer|min:0',
      'pindah' => 'nullable|integer|min:0',
    ]);

    Penduduk::create($data);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil ditambahkan.');
  }

  public function edit(Penduduk $penduduk)
  {
    return view('admin.infografis.edit', compact('penduduk'));
  }

  public function update(Request $request, Penduduk $penduduk)
  {
    $data = $request->validate([
      'dusun' => 'required|string',
      'total_penduduk' => 'required|integer|min:0',
      'laki_laki' => 'required|integer|min:0',
      'perempuan' => 'required|integer|min:0',
      'kepala_keluarga' => 'required|integer|min:0',
      'wajib_ktp' => 'nullable|integer|min:0',
      'lahir' => 'nullable|integer|min:0',
      'datang' => 'nullable|integer|min:0',
      'mati' => 'nullable|integer|min:0',
      'pindah' => 'nullable|integer|min:0',
    ]);

    $penduduk->update($data);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil diupdate.');
  }

  public function destroy(Penduduk $penduduk)
  {
    $penduduk->delete();
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil dihapus.');
  }
}
