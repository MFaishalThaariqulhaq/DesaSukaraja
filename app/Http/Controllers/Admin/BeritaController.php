<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
  public function index()
  {
    $beritas = Berita::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.berita.index', compact('beritas'));
  }

  public function create()
  {
    return view('admin.berita.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'judul' => 'required',
      'isi' => 'required',
      'kategori' => 'required',
      'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);
    $slug = Str::slug($request->judul);
    $gambarPath = null;
    if ($request->hasFile('gambar')) {
      $gambarPath = $request->file('gambar')->store('berita', 'public');
    }
    Berita::create([
      'judul' => $request->judul,
      'slug' => $slug,
      'isi' => $request->isi,
      'kategori' => $request->kategori,
      'gambar' => $gambarPath,
    ]);
    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
  }

  public function edit($id)
  {
    $berita = Berita::findOrFail($id);
    return view('admin.berita.edit', compact('berita'));
  }

  public function update(Request $request, $id)
  {
    $berita = Berita::findOrFail($id);
    $request->validate([
      'judul' => 'required',
      'isi' => 'required',
      'kategori' => 'required',
    ]);
    $slug = Str::slug($request->judul);
    $gambarPath = $berita->gambar;
    if ($request->hasFile('gambar')) {
      // Hapus gambar lama jika ada dan berbeda
      if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
        Storage::disk('public')->delete($gambarPath);
      }
      $gambarPath = $request->file('gambar')->store('berita', 'public');
    }
    $berita->update([
      'judul' => $request->judul,
      'slug' => $slug,
      'isi' => $request->isi,
      'kategori' => $request->kategori,
      'gambar' => $gambarPath,
    ]);
    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
  }

  public function destroy($id)
  {
    $berita = Berita::findOrFail($id);
    $berita->delete();
    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
  }
}
