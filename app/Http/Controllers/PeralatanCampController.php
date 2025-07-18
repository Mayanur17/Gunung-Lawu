<?php

namespace App\Http\Controllers;

use App\Models\PeralatanCamp;
use Illuminate\Http\Request;

class PeralatanCampController extends Controller
{
    public function index() {
        $data = PeralatanCamp::all();
        return view('admin.peralatancamp.index', compact('data'));
    }

    public function create() {
        return view('admin.peralatancamp.create');
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
            PeralatanCamp::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename
            ]);
        } catch (\Exception $e) {
            dd('Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('peralatancamp.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(PeralatanCamp $peralatancamp) {
        return view('admin.peralatancamp.edit', compact('peralatancamp'));
    }

    public function update(Request $request, PeralatanCamp $peralatancamp) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $peralatancamp->gambar = $filename;
        }

        $peralatancamp->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $peralatancamp->gambar
        ]);

        return redirect()->route('peralatancamp.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(PeralatanCamp $peralatancamp) {
        $peralatancamp->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function show(PeralatanCamp $peralatancamp) {
        return view('admin.peralatancamp.show', compact('peralatancamp'));
    }
}
