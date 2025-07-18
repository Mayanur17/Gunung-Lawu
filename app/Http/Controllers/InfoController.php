<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index() {
        $data = Info::all();
        return view('admin.info.index', compact('data'));
    }

    public function create() {
        return view('admin.info.create');
    }

    public function store(Request $request) {
        $request->validate([
            'namakomunitas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }

        try {
            Info::create([
                'namakomunitas' => $request->namakomunitas,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename
            ]);
        } catch (\Exception $e) {
            dd('Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('info.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Info $info) {
        return view('admin.info.edit', compact('info'));
    }

    public function update(Request $request, Info $info) {
        $request->validate([
            'namakomunitas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $info->gambar = $filename;
        }

        $info->update([
            'namakomunitas' => $request->namakomunitas,
            'deskripsi' => $request->deskripsi,
            'gambar' => $info->gambar
        ]);

        return redirect()->route('info.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Info $info) {
        $info->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function show($id) {
        $info = Info::findOrFail($id);
        return view('admin.info.show', compact('info'));
    }
}
