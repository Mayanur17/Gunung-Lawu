<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

        // Upload gambar ke Cloudinary
        $uploadedFileUrl = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $uploadResult = Cloudinary::upload($gambar->getRealPath(), [
                'folder' => 'berita_gununglawu'
            ]);

            $uploadedFileUrl = $uploadResult->getSecurePath();
        }

        // Simpan data ke database
        Berita::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $uploadedFileUrl,
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
            $gambar = $request->file('gambar');
            $uploadResult = Cloudinary::upload($gambar->getRealPath(), [
                'folder' => 'berita_gununglawu'
            ]);

            $data['gambar'] = $uploadResult->getSecurePath();
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
}
