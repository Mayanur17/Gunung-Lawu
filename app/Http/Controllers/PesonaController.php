<?php


namespace App\Http\Controllers;
use App\Models\PesonaLawu;
use Illuminate\Http\Request;

class PesonaController extends Controller
{
    public function index() {
    $data = PesonaLawu::all();
    return view('admin.pesona.index', compact('data'));
}

public function create() {
    return view('admin.pesona.create');
}
public function store(Request $request) {
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'required|image|file|max:2048'
    ]);

    $filename = null;
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filename = $file->storeAs('images', $filename, 'public'); 
    }

    PesonaLawu::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'gambar' => $filename
    ]);

    return redirect()->route('pesona.index')->with('success', 'Data berhasil ditambahkan');
}

public function edit(PesonaLawu $pesona) {
    return view('admin.pesona.edit', compact('pesona'));
}

public function update(Request $request, PesonaLawu $pesona) {
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'nullable|image|file|max:2048'
    ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $pesona->gambar = $filename;
    }

    $pesona->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'gambar' => $pesona->gambar
    ]);

    return redirect()->route('pesona.index')->with('success', 'Data berhasil diupdate');
}


public function destroy(PesonaLawu $pesona) {
    $pesona->delete();
    return back()->with('success', 'Data berhasil dihapus');
}
public function show($id) {
    $pesona = PesonaLawu::findOrFail($id);
    return view('admin.pesona.show', compact('pesona'));
}

}