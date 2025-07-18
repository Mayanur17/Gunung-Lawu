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

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }

        try {
            Berita::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename
            ]);
        } catch (\Exception $e) {
            dd('Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita) {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $berita->gambar = $filename;
        }

        $berita->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $berita->gambar
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita) {
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

    public function show(Berita $berita) {
        return view('admin.berita.show', compact('berita'));
    }
}