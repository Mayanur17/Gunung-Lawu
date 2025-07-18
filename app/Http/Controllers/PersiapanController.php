<?php

namespace App\Http\Controllers;

use App\Models\Persiapan;
use Illuminate\Http\Request;

class PersiapanController extends Controller
{
    public function index() {
        $data = Persiapan::all();
        return view('admin.persiapan.index', compact('data'));
    }

    public function create() {
        return view('admin.persiapan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);

        try {
            Persiapan::create([
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi
            ]);
        } catch (\Exception $e) {
            dd('Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->route('persiapan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Persiapan $persiapan) {
        return view('admin.persiapan.edit', compact('persiapan'));
    }

    public function update(Request $request, Persiapan $persiapan) {
        $request->validate([
            'jenis' => 'required',
            'deskripsi' => 'required'
        ]);

        $persiapan->update([
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('persiapan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Persiapan $persiapan) {
        $persiapan->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function show(Persiapan $persiapan) {
        return view('admin.persiapan.show', compact('persiapan'));
    }
}
