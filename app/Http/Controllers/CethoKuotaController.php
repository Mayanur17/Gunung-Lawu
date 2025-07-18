<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CethoKuota;

class CethoKuotaController extends Controller
{
    public function index()
    {
        $data = CethoKuota::orderBy('tanggal', 'asc')->get();
        return view('admin.kuota.cetho.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:cetho_kuota,tanggal',
            'kuota' => 'required|integer|min:0'
        ]);

        CethoKuota::create($request->only(['tanggal', 'kuota']));

        return redirect()->back()->with('success', 'Kuota berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0'
        ]);

        $item = CethoKuota::findOrFail($id);
        $item->update(['kuota' => $request->kuota]);

        return redirect()->back()->with('success', 'Kuota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        CethoKuota::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
