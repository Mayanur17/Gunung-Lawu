<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CeritaPendaki;
use App\Models\BalasanCerita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CeritaPendakiController extends Controller
{
    // Tampilkan semua cerita & balasan
    public function index()
    {
        $cerita = CeritaPendaki::with(['user', 'balasan.user'])->latest()->get();
        return view('pendaki.cerita', compact('cerita'));
    }

    // Simpan cerita baru
    public function simpan(Request $request)
    {
        $request->validate([
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('public/cerita');
        $item->gambar = str_replace('public/', '', $path); // hasil: cerita/namafile.jpg
        }

        CeritaPendaki::create([
            'user_id' => Auth::id(), // simpan ID pengguna
            'isi' => $request->isi,
            'gambar' => $gambar,
        ]);

        return redirect()->back()->with('success', 'Cerita berhasil dikirim!');
    }

    // Simpan balasan dari user lain
    public function balas(Request $request, $cerita_id)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        BalasanCerita::create([
            'cerita_id' => $cerita_id,
            'user_id' => Auth::id(), // simpan ID pengguna
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
    public function edit($id)
{
    $cerita = Cerita::findOrFail($id);
    if ($cerita->user_id != Auth::id()) {
        abort(403);
    }
    return view('pendaki.cerita_edit', compact('cerita'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'isi' => 'required|string'
    ]);

    $cerita = Cerita::findOrFail($id);

    if (auth()->id() !== $cerita->user_id) {
        abort(403);
    }

    $cerita->update([
        'isi' => $request->isi
    ]);

    return redirect()->back()->with('success', 'Cerita berhasil diperbarui.');
}


public function hapus($id)
{
    $cerita = Cerita::findOrFail($id);
    if ($cerita->user_id != Auth::id()) {
        abort(403);
    }
    $cerita->delete();

    return redirect()->back()->with('success', 'Cerita berhasil dihapus.');
}

}
