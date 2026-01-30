<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
  public function index()
  {
    $galeris = Galeri::orderBy('created_at', 'desc')->get();
    return view('admin.galeri.index', compact('galeris'));
  }
  public function create()
  {
    return view('admin.galeri.create');
  }
  public function store(Request $request)
  {
    $request->validate([
      'judul' => 'required',
      'kategori' => 'required|in:Kegiatan,Alam & Wisata,Pembangunan',
      'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
      'deskripsi' => 'nullable|string',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
      $gambarPath = $request->file('gambar')->store('galeri', 'public');
    }

    Galeri::create([
      'judul' => $request->judul,
      'kategori' => $request->kategori,
      'gambar' => $gambarPath,
      'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan');
  }
  public function edit($id)
  {
    $galeri = Galeri::findOrFail($id);
    return view('admin.galeri.edit', compact('galeri'));
  }
  public function update(Request $request, $id)
  {
    $galeri = Galeri::findOrFail($id);
    $request->validate([
      'judul' => 'required',
      'kategori' => 'required|in:Kegiatan,Alam & Wisata,Pembangunan',
      'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
      'deskripsi' => 'nullable|string',
    ]);

    $gambarPath = $galeri->gambar;
    if ($request->hasFile('gambar')) {
      if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
        Storage::disk('public')->delete($gambarPath);
      }
      $gambarPath = $request->file('gambar')->store('galeri', 'public');
    }

    $galeri->update([
      'judul' => $request->judul,
      'kategori' => $request->kategori,
      'gambar' => $gambarPath,
      'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diupdate');
  }
  public function destroy($id)
  {
    $galeri = Galeri::findOrFail($id);
    $galeri->delete();
    return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus');
  }
}
