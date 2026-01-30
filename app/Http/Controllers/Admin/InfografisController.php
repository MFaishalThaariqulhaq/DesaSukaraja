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
      // Kelompok Usia
      'kelompok_usia_0_5' => 'nullable|integer|min:0',
      'kelompok_usia_6_11' => 'nullable|integer|min:0',
      'kelompok_usia_12_17' => 'nullable|integer|min:0',
      'kelompok_usia_18_25' => 'nullable|integer|min:0',
      'kelompok_usia_26_35' => 'nullable|integer|min:0',
      'kelompok_usia_36_45' => 'nullable|integer|min:0',
      'kelompok_usia_46_60' => 'nullable|integer|min:0',
      'kelompok_usia_61_keatas' => 'nullable|integer|min:0',
      // Pendidikan
      'pendidikan_sd' => 'nullable|integer|min:0',
      'pendidikan_smp' => 'nullable|integer|min:0',
      'pendidikan_sma' => 'nullable|integer|min:0',
      'pendidikan_diploma' => 'nullable|integer|min:0',
      'pendidikan_belum' => 'nullable|integer|min:0',
      // Pekerjaan
      'pekerjaan_petani' => 'nullable|integer|min:0',
      'pekerjaan_wiraswasta' => 'nullable|integer|min:0',
      'pekerjaan_karyawan' => 'nullable|integer|min:0',
      'pekerjaan_pns' => 'nullable|integer|min:0',
      'pekerjaan_ibu_rumah_tangga' => 'nullable|integer|min:0',
      'pekerjaan_belum' => 'nullable|integer|min:0',
      // Agama
      'agama_islam' => 'nullable|integer|min:0',
      'agama_kristen' => 'nullable|integer|min:0',
      'agama_katolik' => 'nullable|integer|min:0',
      'agama_hindu' => 'nullable|integer|min:0',
      'agama_buddha' => 'nullable|integer|min:0',
    ]);

    // Convert empty values to 0 for nullable fields
    $nullableFields = [
      'wajib_ktp', 'lahir', 'datang', 'mati', 'pindah',
      'kelompok_usia_0_5', 'kelompok_usia_6_11', 'kelompok_usia_12_17', 'kelompok_usia_18_25',
      'kelompok_usia_26_35', 'kelompok_usia_36_45', 'kelompok_usia_46_60', 'kelompok_usia_61_keatas',
      'pendidikan_sd', 'pendidikan_smp', 'pendidikan_sma', 'pendidikan_diploma', 'pendidikan_belum',
      'pekerjaan_petani', 'pekerjaan_wiraswasta', 'pekerjaan_karyawan', 'pekerjaan_pns',
      'pekerjaan_ibu_rumah_tangga', 'pekerjaan_belum',
      'agama_islam', 'agama_kristen', 'agama_katolik', 'agama_hindu', 'agama_buddha'
    ];

    foreach ($nullableFields as $field) {
      if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
        $data[$field] = 0;
      }
    }

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
      // Kelompok Usia
      'kelompok_usia_0_5' => 'nullable|integer|min:0',
      'kelompok_usia_6_11' => 'nullable|integer|min:0',
      'kelompok_usia_12_17' => 'nullable|integer|min:0',
      'kelompok_usia_18_25' => 'nullable|integer|min:0',
      'kelompok_usia_26_35' => 'nullable|integer|min:0',
      'kelompok_usia_36_45' => 'nullable|integer|min:0',
      'kelompok_usia_46_60' => 'nullable|integer|min:0',
      'kelompok_usia_61_keatas' => 'nullable|integer|min:0',
      // Pendidikan
      'pendidikan_sd' => 'nullable|integer|min:0',
      'pendidikan_smp' => 'nullable|integer|min:0',
      'pendidikan_sma' => 'nullable|integer|min:0',
      'pendidikan_diploma' => 'nullable|integer|min:0',
      'pendidikan_belum' => 'nullable|integer|min:0',
      // Pekerjaan
      'pekerjaan_petani' => 'nullable|integer|min:0',
      'pekerjaan_wiraswasta' => 'nullable|integer|min:0',
      'pekerjaan_karyawan' => 'nullable|integer|min:0',
      'pekerjaan_pns' => 'nullable|integer|min:0',
      'pekerjaan_ibu_rumah_tangga' => 'nullable|integer|min:0',
      'pekerjaan_belum' => 'nullable|integer|min:0',
      // Agama
      'agama_islam' => 'nullable|integer|min:0',
      'agama_kristen' => 'nullable|integer|min:0',
      'agama_katolik' => 'nullable|integer|min:0',
      'agama_hindu' => 'nullable|integer|min:0',
      'agama_buddha' => 'nullable|integer|min:0',
    ]);

    // Convert empty values to 0 for nullable fields
    $nullableFields = [
      'wajib_ktp', 'lahir', 'datang', 'mati', 'pindah',
      'kelompok_usia_0_5', 'kelompok_usia_6_11', 'kelompok_usia_12_17', 'kelompok_usia_18_25',
      'kelompok_usia_26_35', 'kelompok_usia_36_45', 'kelompok_usia_46_60', 'kelompok_usia_61_keatas',
      'pendidikan_sd', 'pendidikan_smp', 'pendidikan_sma', 'pendidikan_diploma', 'pendidikan_belum',
      'pekerjaan_petani', 'pekerjaan_wiraswasta', 'pekerjaan_karyawan', 'pekerjaan_pns',
      'pekerjaan_ibu_rumah_tangga', 'pekerjaan_belum',
      'agama_islam', 'agama_kristen', 'agama_katolik', 'agama_hindu', 'agama_buddha'
    ];

    foreach ($nullableFields as $field) {
      if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
        $data[$field] = 0;
      }
    }

    $penduduk->update($data);
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil diupdate.');
  }

  public function destroy(Penduduk $penduduk)
  {
    $penduduk->delete();
    return redirect()->route('admin.infografis.index')->with('success', 'Data penduduk berhasil dihapus.');
  }
}
