<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CemorosewuKuota;

class CemorosewuKuotaController extends Controller
{
    public function index()
    {
        $data = CemorosewuKuota::orderBy('tanggal', 'asc')->get();
        return view('admin.kuota.cemorosewu.index', compact('data'));
    }
    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date|after_or_equal:' . Carbon::now('Asia/Jakarta')->toDateString(),
        'kuota' => 'required|integer|min:0'
    ]);

    CemorosewuKuota::create($request->only(['tanggal', 'kuota']));

    return redirect()->back()->with('success', 'Kuota berhasil ditambahkan.');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0'
        ]);

        $item = CemorosewuKuota::findOrFail($id);
        $item->update(['kuota' => $request->kuota]);

        return redirect()->back()->with('success', 'Kuota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        CemorosewuKuota::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
