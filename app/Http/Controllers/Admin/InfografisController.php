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
      'total_penduduk' => 'required|integer',
      'laki_laki' => 'required|integer',
      'perempuan' => 'required|integer',
      'kepala_keluarga' => 'required|integer',
      'wajib_ktp' => 'nullable|integer',
      'lahir' => 'nullable|integer',
      'datang' => 'nullable|integer',
      'mati' => 'nullable|integer',
      'pindah' => 'nullable|integer',
    ]);
    Penduduk::create($data);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil ditambahkan.');
  }

  public function edit(Penduduk $infografis)
  {
    return view('admin.infografis.edit', ['penduduk' => $infografis]);
  }

  public function update(Request $request, Penduduk $infografis)
  {
    $data = $request->validate([
      'dusun' => 'required|string',
      'total_penduduk' => 'required|integer',
      'laki_laki' => 'required|integer',
      'perempuan' => 'required|integer',
      'kepala_keluarga' => 'required|integer',
      'wajib_ktp' => 'nullable|integer',
      'lahir' => 'nullable|integer',
      'datang' => 'nullable|integer',
      'mati' => 'nullable|integer',
      'pindah' => 'nullable|integer',
    ]);
    $infografis->update($data);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil diupdate.');
  }

  public function destroy(Penduduk $infografis)
  {
    $infografis->delete();
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil dihapus.');
  }
}
