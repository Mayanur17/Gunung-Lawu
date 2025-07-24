<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index() {
        $data = Berita::all();
        return view('admin.berita.index', compact('data'));
    }

    public function create() {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'required|image|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = file_get_contents($request->file('gambar')->getRealPath());
        }

        Berita::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar,
        ]);

        return back()->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita) {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = file_get_contents($request->file('gambar')->getRealPath());
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita) {
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

    public function show(Berita $berita) {
        return view('admin.berita.show', compact('berita'));
    }

    public function tampilkanGambar($id)
    {
        $berita = Berita::findOrFail($id);

        return response($berita->gambar)->header('Content-Type', 'image/jpeg');
    }
}
