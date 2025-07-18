<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $data = Jalur::all();
        return view('admin.jalur.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jalur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jalur_pendakian' => 'required',
            'alamat_jalur' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|file|max:2048',
            'gambar_peta' => 'required|image|file|max:2048',
        ]);

        $gambar = null;
        $gambarPeta = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = time() . '_1_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $gambar);
        }

        if ($request->hasFile('gambar_peta')) {
            $filePeta = $request->file('gambar_peta');
            $gambarPeta = time() . '_2_' . $filePeta->getClientOriginalName();
            $filePeta->move(public_path('images'), $gambarPeta);
        }

        Jalur::create([
            'jalur_pendakian' => $request->jalur_pendakian,
            'alamat_jalur' => $request->alamat_jalur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'gambar_peta' => $gambarPeta
        ]);

        return redirect()->route('jalur.index')->with('success', 'Data jalur berhasil ditambahkan');
    }

    public function edit(Jalur $jalur)
    {
        return view('admin.jalur.edit', compact('jalur'));
    }

    public function update(Request $request, Jalur $jalur)
    {
        $request->validate([
            'jalur_pendakian' => 'required',
            'alamat_jalur' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|file|max:2048',
            'gambar_peta' => 'nullable|image|file|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $jalur->gambar = time() . '_1_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $jalur->gambar);
        }

        if ($request->hasFile('gambar_peta')) {
            $filePeta = $request->file('gambar_peta');
            $jalur->gambar_peta = time() . '_2_' . $filePeta->getClientOriginalName();
            $filePeta->move(public_path('images'), $jalur->gambar_peta);
        }

        $jalur->update([
            'jalur_pendakian' => $request->jalur_pendakian,
            'alamat_jalur' => $request->alamat_jalur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $jalur->gambar,
            'gambar_peta' => $jalur->gambar_peta
        ]);

        return redirect()->route('jalur.index')->with('success', 'Data jalur berhasil diupdate');
    }

    public function destroy(Jalur $jalur)
    {
        $jalur->delete();
        return back()->with('success', 'Data jalur berhasil dihapus');
    }

    public function show($id)
    {
        $jalur = Jalur::findOrFail($id);
        return view('admin.jalur.show', compact('jalur'));
    }
}
