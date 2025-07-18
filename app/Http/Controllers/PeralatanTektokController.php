<?php

namespace App\Http\Controllers;

use App\Models\PeralatanTektok;
use Illuminate\Http\Request;

class PeralatanTektokController extends Controller
{
    public function index() {
        $data = PeralatanTektok::all();
        return view('admin.peralatantektok.index', compact('data'));
    }

    public function create() {
        return view('admin.peralatantektok.create');
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
            PeralatanTektok::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename
            ]);
        } catch (\Exception $e) {
            dd('Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('peralatantektok.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(PeralatanTektok $peralatantektok) {
        return view('admin.peralatantektok.edit', compact('peralatantektok'));
    }

    public function update(Request $request, PeralatanTektok $peralatantektok) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $peralatantektok->gambar = $filename;
        }

        $peralatantektok->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $peralatantektok->gambar
        ]);

        return redirect()->route('peralatantektok.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(PeralatanTektok $peralatantektok) {
        $peralatantektok->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function show(PeralatanTektok $peralatantektok) {
        return view('admin.peralatantektok.show', compact('peralatantektok'));
    }
}
