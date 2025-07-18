<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CemorokandangKuota;

class CemorokandangKuotaController extends Controller
{
    // Tampilkan daftar kuota
    public function index()
    {
        $data = CemorokandangKuota::orderBy('tanggal', 'asc')->get();
        return view('admin.kuota.cemorokandang.index', compact('data'));
    }

    // Simpan kuota baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today|unique:cemorokandang_kuota,tanggal',
            'kuota'   => 'required|integer|min:0',
        ]);

        CemorokandangKuota::create([
            'tanggal' => $request->tanggal,
            'kuota'   => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Kuota berhasil ditambahkan.');
    }

    // Update kuota
    public function update(Request $request, $id)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0',
        ]);

        $item = CemorokandangKuota::findOrFail($id);
        $item->update([
            'kuota' => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Kuota berhasil diperbarui.');
    }

    // Hapus kuota
    public function destroy($id)
    {
        $item = CemorokandangKuota::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
