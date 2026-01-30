<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use App\Models\SejarahDesa;

class ProfilDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = ProfilDesa::first();
        $sejarah = SejarahDesa::orderBy('tahun')->get();
        return view('admin.profil.index', compact('profil', 'sejarah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_profil' => 'nullable|string',
            'motto_profil' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'nama_kades' => 'required|string',
            'periode_kades' => 'required|string',
            'foto_kades' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sambutan_kades' => 'nullable|string',
            'judul_sambutan_kades' => 'nullable|string|max:255',
            'isi_sambutan_kades' => 'nullable|string',
            'ttd_kades' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('profil', 'public');
        }
        if ($request->hasFile('foto_kades')) {
            $validated['foto_kades'] = $request->file('foto_kades')->store('kades', 'public');
        }
        if ($request->hasFile('ttd_kades')) {
            $validated['ttd_kades'] = $request->file('ttd_kades')->store('ttd', 'public');
        }
        if ($request->hasFile('struktur_organisasi')) {
            $validated['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }
        // Misi: array to string
        if (is_array($request->misi)) {
            $validated['misi'] = implode("\n", array_filter($request->misi));
        }
        ProfilDesa::create($validated);
        return redirect()->route('admin.profil.index')->with('success', 'Profil desa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profil = ProfilDesa::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'sometimes|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_profil' => 'nullable|string',
            'motto_profil' => 'nullable|string',
            'visi' => 'sometimes|string',
            'misi' => 'sometimes',
            'nama_kades' => 'sometimes|string',
            'periode_kades' => 'sometimes|string',
            'foto_kades' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sambutan_kades' => 'sometimes|string',
            'judul_sambutan_kades' => 'nullable|string|max:255',
            'isi_sambutan_kades' => 'nullable|string',
            'ttd_kades' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('profil', 'public');
        }
        if ($request->hasFile('foto_kades')) {
            $validated['foto_kades'] = $request->file('foto_kades')->store('kades', 'public');
        }
        if ($request->hasFile('ttd_kades')) {
            $validated['ttd_kades'] = $request->file('ttd_kades')->store('ttd', 'public');
        }
        if ($request->hasFile('struktur_organisasi')) {
            $validated['struktur_organisasi'] = $request->file('struktur_organisasi')->store('struktur', 'public');
        }
        // Misi: array to string
        if (is_array($request->misi)) {
            $validated['misi'] = implode("\n", array_filter($request->misi));
        }
        $profil->update($validated);
        return redirect()->route('admin.profil.index')->with('success', 'Profil desa berhasil diperbarui.');
    }

    // CRUD Sejarah Desa
    public function tambahSejarah(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|string',
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }
        $validated['profil_desa_id'] = ProfilDesa::first()->id ?? null;
        SejarahDesa::create($validated);
        return back()->with('success', 'Peristiwa sejarah berhasil ditambahkan.');
    }
    public function hapusSejarah($id)
    {
        $item = SejarahDesa::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Peristiwa sejarah berhasil dihapus.');
    }
}
