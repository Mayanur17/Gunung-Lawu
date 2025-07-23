<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CeritaPendaki;
use App\Models\BalasanCerita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CeritaPendakiController extends Controller
{
    public function index()
    {
        $cerita = CeritaPendaki::with(['user', 'balasan.user'])->latest()->get();
        return view('pendaki.cerita', compact('cerita'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $request->hasFile('gambar')
            ? $request->file('gambar')->store('cerita', 'public')
            : null;

        CeritaPendaki::create([
            'user_id' => auth()->id(),
            'isi' => $request->isi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Cerita berhasil dikirim!');
    }

    public function balas(Request $request, $cerita_id)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        BalasanCerita::create([
            'cerita_id' => $cerita_id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}