<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sotk;

class SotkController extends Controller
{
  public function index()
  {
    $sotks = Sotk::orderBy('jabatan')->get();
    return view('admin.sotk.index', compact('sotks'));
  }
  public function create()
  {
    return view('admin.sotk.create');
  }
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'jabatan' => 'required',
      'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
      'tupoksi' => 'nullable|string',
      'badge_color' => 'nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/',
      'overlay_bg_color' => 'nullable|string',
      'icon_color' => 'nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/',
      'icon_name' => 'nullable|string',
    ]);
    $data = $request->except('foto');
    if ($request->hasFile('foto')) {
      $data['foto'] = $request->file('foto')->store('sotk_foto', 'public');
    }
    Sotk::create($data);
    return redirect()->route('admin.sotk.index')->with('success', 'SOTK berhasil ditambahkan');
  }
  public function edit($id)
  {
    $sotk = Sotk::findOrFail($id);
    return view('admin.sotk.edit', compact('sotk'));
  }
  public function update(Request $request, $id)
  {
    $sotk = Sotk::findOrFail($id);
    $request->validate([
      'nama' => 'required',
      'jabatan' => 'required',
      'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
      'tupoksi' => 'nullable|string',
      'badge_color' => 'nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/',
      'overlay_bg_color' => 'nullable|string',
      'icon_color' => 'nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/',
      'icon_name' => 'nullable|string',
    ]);
    $data = $request->except('foto');
    if ($request->hasFile('foto')) {
      $data['foto'] = $request->file('foto')->store('sotk_foto', 'public');
    }
    $sotk->update($data);
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
  public function baganUpload(Request $request)
  {
    $request->validate([
      'bagan' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);
    $baganPath = $request->file('bagan')->store('sotk_bagan', 'public');
    // Simpan path bagan ke database, misal di model Sotk dengan jabatan khusus 'Bagan'
    \App\Models\Sotk::updateOrCreate(
      ['jabatan' => 'Bagan'],
      ['foto' => $baganPath, 'nama' => 'Bagan Struktur Organisasi']
    );
    return redirect()->route('admin.sotk.index')->with('success', 'Bagan organisasi berhasil diupload');
  }
}
