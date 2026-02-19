<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
  public function index(Request $request)
  {
    $query = Galeri::query();

    if ($request->filled('q')) {
      $q = $request->query('q');
      $query->where('judul', 'like', "%{$q}%");
    }

    if ($request->filled('kategori')) {
      $query->where('kategori', $request->query('kategori'));
    }

    $allowedPerPage = [5, 10, 15];
    $perPage = (int) $request->query('per_page', 10);
    if (!in_array($perPage, $allowedPerPage, true)) {
      $perPage = 10;
    }

    $galeris = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
    $categories = Galeri::whereNotNull('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

    return view('admin.galeri.index', compact('galeris', 'perPage', 'categories'));
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
      'remove_gambar' => 'nullable|boolean',
      'deskripsi' => 'nullable|string',
    ]);

    $gambarPath = $galeri->gambar;
    if ($request->boolean('remove_gambar') && $gambarPath && Storage::disk('public')->exists($gambarPath)) {
      Storage::disk('public')->delete($gambarPath);
      $gambarPath = null;
    }

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
    if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
      Storage::disk('public')->delete($galeri->gambar);
    }
    $galeri->delete();
    return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus');
  }
}
