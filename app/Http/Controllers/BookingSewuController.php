<?php

namespace App\Http\Controllers;

use App\Models\CemorosewuDetail;
use App\Models\CemorosewuAnggota;
use App\Models\CemorosewuKuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingSewuController extends Controller
{
    public function form()
    {
        $booking = CemorosewuDetail::where('user_id', Auth::id())->latest()->get();
        return view('pendaki.bookingcemorosewu', compact('booking'));
    }

    public function simpan(Request $request)
{
    $request->validate([
        'tanggal_pendakian' => 'required|date',
        'tanggal_turun' => 'required|date',
        'jumlah_pendaki' => 'required|integer|min:2', 
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
    $kuota = CemorosewuKuota::where('tanggal', $request->tanggal_pendakian)->first();
    if (!$kuota) {
        return back()->with('error', 'Kuota belum tersedia untuk tanggal tersebut.');
    }

    // 2. Hitung total pendaki yang sudah booking dan status aktif
    $total_terpakai = CemorosewuDetail::where('tanggal_pendakian', $request->tanggal_pendakian)
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
        $path = $request->file('foto_identitas')->store('identitas', 'public');
    }

    // 5. Simpan booking
    $booking = CemorosewuDetail::create([
        'user_id' => Auth::id(),
        'tanggal_pendakian' => $request->tanggal_pendakian,
        'tanggal_turun' => $request->tanggal_turun,
        'jalur' => 'Cemoro Sewu',
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
            CemorosewuAnggota::create([
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
        $data = CemorosewuDetail::with('anggota')->latest()->get();
        return view('admin.booking.cemorosewu.index', compact('data'));
    }

    public function approve($id)
    {
        $booking = CemorosewuDetail::findOrFail($id);
        $booking->status = 'approve';
        $booking->save();

        return redirect()->back()->with('success', 'Booking disetujui.');
    }

    public function cekKuota(Request $request)
    {
        $tanggal = $request->tanggal;
        $kuota = CemorosewuKuota::where('tanggal', $tanggal)->first();
        $totalBooking = CemorosewuDetail::where('tanggal_pendakian', $tanggal)->sum('jumlah_pendaki');

        return response()->json([
            'kuota_penuh' => $kuota && $totalBooking >= $kuota->kuota,
            'total_kuota' => $kuota ? $kuota->kuota : 0,
            'terpakai' => $totalBooking,
            'sisa_kuota' => $kuota ? max($kuota->kuota - $totalBooking, 0) : 0,
        ]);
    }

    public function show($id)
    {
        $booking = CemorosewuDetail::with('anggota')->findOrFail($id);
        return view('admin.booking.cemorosewu.detail', compact('booking'));
    }

    public function decline(Request $request, $id)
    {
        $request->validate(['alasan' => 'required']);

        $booking = CemorosewuDetail::findOrFail($id);
        $booking->status = 'decline';
        $booking->keterangan_admin = $request->alasan;
        $booking->save();

        return redirect()->back()->with('success', 'Booking ditolak.');
    }
}
