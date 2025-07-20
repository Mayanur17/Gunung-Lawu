<?php

namespace App\Http\Controllers;

use App\Models\CemorokandangDetail;
use App\Models\CemorokandangAnggota;
use App\Models\CemorokandangKuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingKandangController extends Controller
{
    public function form()
    {
        $booking = CemorokandangDetail::where('user_id', Auth::id())->latest()->get();
        return view('pendaki.bookingcemorokandang', compact('booking'));
    }

    public function simpan(Request $request)
{
    $request->validate([
        'tanggal_pendakian' => 'required|date',
        'tanggal_turun' => 'required|date',
        'jumlah_pendaki' => 'required|integer|min:2', // minimal 2 pendaki
        'nama_ketua' => 'required',
        'tanggal_lahir_ketua' => 'required|date',
        'jenis_kelamin_ketua' => 'required',
        'alamat_ketua' => 'required',
        'no_identitas_ketua' => 'required',
        'no_telp' => 'required',
        'email' => 'required|email',
        'foto_identitas' => 'nullable|image|max:2048',
        'anggota' => ['required', function ($attribute, $value, $fail) {
            $lines = explode("\n", $value);
            foreach ($lines as $line) {
                $parts = array_map('trim', explode(',', $line));
                if (count($parts) !== 4 || in_array('', $parts)) {
                    $fail('Format penulisan anggota salah. Gunakan format: Nama, Jenis Kelamin, Alamat, No HP');
                    break;
                }
            }
        }],
    ], [
        'jumlah_pendaki.min' => 'Jumlah pendaki minimal 2 orang (termasuk ketua).',
        'anggota.required' => 'Data anggota tidak boleh kosong.',
    ]);

    // 1. Cek apakah kuota tersedia di tanggal yang dipilih
    $kuota = CemorokandangKuota::where('tanggal', $request->tanggal_pendakian)->first();
    if (!$kuota) {
        return back()->with('error', 'Kuota belum tersedia untuk tanggal tersebut.');
    }

    // 2. Hitung total pendaki yang sudah booking dan status aktif
    $total_terpakai = CemorokandangDetail::where('tanggal_pendakian', $request->tanggal_pendakian)
        ->whereIn('status', ['approve', 'pending', 'menunggu'])
        ->sum('jumlah_pendaki');

    $sisa_kuota = $kuota->kuota - $total_terpakai;

    // 3. Cek apakah jumlah_pendaki melebihi sisa kuota
    if ($request->jumlah_pendaki > $sisa_kuota) {
        return back()->with('error', 'Sisa kuota hanya ' . $sisa_kuota . ' orang. Anda mencoba mendaftar ' . $request->jumlah_pendaki . ' orang.');
    }

    // 4. Upload foto jika ada
    $path = null;
    if ($request->hasFile('foto_identitas')) {
    $file = $request->file('foto_identitas');
    $nama_file = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('images'), $nama_file);
    $path = 'images/' . $nama_file; 
}


    // 5. Simpan booking
    $booking = CemorokandangDetail::create([
        'user_id' => Auth::id(),
        'tanggal_pendakian' => $request->tanggal_pendakian,
        'tanggal_turun' => $request->tanggal_turun,
        'jalur' => 'Cemoro Kandang',
        'jumlah_pendaki' => $request->jumlah_pendaki,
        'nama_ketua' => $request->nama_ketua,
        'tanggal_lahir_ketua' => $request->tanggal_lahir_ketua,
        'jenis_kelamin_ketua' => $request->jenis_kelamin_ketua,
        'alamat_ketua' => $request->alamat_ketua,
        'no_identitas_ketua' => $request->no_identitas_ketua,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'foto_identitas' => $path,
        'status' => 'menunggu'
    ]);

    // 6. Simpan anggota
    $lines = explode("\n", $request->anggota);
    foreach ($lines as $line) {
        $parts = array_map('trim', explode(',', $line));
        if (count($parts) === 4) {
            CemorokandangAnggota::create([
                'booking_id' => $booking->id,
                'nama' => $parts[0],
                'jenis_kelamin' => $parts[1],
                'alamat' => $parts[2],
                'no_telp' => $parts[3],
            ]);
        }
    }

    return back()->with('success', 'Booking berhasil, menunggu konfirmasi admin.');
}










    public function index()
    {
        $data = CemorokandangDetail::with('anggota')->latest()->get();
        return view('admin.booking.cemorokandang.index', compact('data'));
    }

    public function approve($id)
    {
        $booking = CemorokandangDetail::findOrFail($id);
        $booking->status = 'approve';
        $booking->save();

        return redirect()->back()->with('success', 'Booking disetujui.');
    }

    public function cekKuota(Request $request)
    {
        $tanggal = $request->tanggal;
        $kuota = CemorokandangKuota::where('tanggal', $tanggal)->first();
        $totalBooking = CemorokandangDetail::where('tanggal_pendakian', $tanggal)->sum('jumlah_pendaki');

        return response()->json([
            'kuota_penuh' => $kuota && $totalBooking >= $kuota->kuota,
            'total_kuota' => $kuota ? $kuota->kuota : 0,
            'terpakai' => $totalBooking,
            'sisa_kuota' => $kuota ? max($kuota->kuota - $totalBooking, 0) : 0,
        ]);
    }

    public function show($id)
    {
        $booking = CemorokandangDetail::with('anggota')->findOrFail($id);
        return view('admin.booking.cemorokandang.detail', compact('booking'));
    }

    public function decline(Request $request, $id)
    {
        $request->validate(['alasan' => 'required']);

        $booking = CemorokandangDetail::findOrFail($id);
        $booking->status = 'decline';
        $booking->keterangan_admin = $request->alasan;
        $booking->save();

        return redirect()->back()->with('success', 'Booking ditolak.');
    }
}
