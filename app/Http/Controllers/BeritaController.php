<?php

namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        'gambar' => 'required|image|max:2048',
    ]);

    $uploadedFileUrl = Cloudinary::upload($request->file('gambar')->getRealPath())->getSecurePath();

    Berita::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'gambar' => $uploadedFileUrl, 
    ]);

    return back()->with('success', 'Berita berhasil ditambahkan');
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
   
        $uploadedFileUrl = Cloudinary::upload($request->file('gambar')->getRealPath())->getSecurePath();
        $berita->gambar = $uploadedFileUrl; 
    }

    $berita->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'gambar' => $berita->gambar, 
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