@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="booking-container">
    <h2>Form Booking Pendakian Gunung Lawu</h2>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <form action="{{ route('booking.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Info Tanggal --}}
        <fieldset>
            <legend>Tanggal Pendakian</legend>
            <label for="tanggal_berangkat">Tanggal Berangkat:</label>
            <input type="date" name="tanggal_pendakian" id="tanggal_berangkat" required>
            <div id="kuotaInfo" style="margin-top: 5px; font-size: 14px;"></div>
            <small id="kuotaWarning" style="color:red; display:none;">Kuota penuh untuk tanggal ini!</small>
        </fieldset>

        {{-- Ketua Kelompok --}}
        <fieldset>
            <legend>Data Ketua Kelompok</legend>

            <label>Nama Ketua:</label>
            <input type="text" name="nama_ketua" required>

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir_ketua" required>

            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin_ketua" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label>Alamat:</label>
            <textarea name="alamat_ketua" required></textarea>

            <label>No. Identitas (KTP/SIM):</label>
            <input type="text" name="no_identitas_ketua" required>

            <label>No. HP / WA:</label>
            <input type="text" name="no_telp" required>

            <label>Email Aktif:</label>
            <input type="email" name="email" required>

            <label>Unggah Foto Identitas:</label>
            <input type="file" name="foto_identitas" accept="image/*" required>
        </fieldset>

        {{-- Data Anggota --}}
        <fieldset>
            <legend>Data Anggota</legend>
            <p>Masukkan anggota dalam format: <strong>Nama | Jenis Kelamin | Alamat | No HP</strong></p>
            <p>Satu baris untuk satu orang. Contoh:</p>
            <pre>Budi Budianto | Laki-laki | Boyolali | 0812345678
Siti Fatmah | Perempuan | Surakarta | 0822334455</pre>
            <textarea name="anggota" rows="5" placeholder="Contoh:
Siti Fatmah | Perempuan | Surakarta | 0822334455"></textarea>
        </fieldset>

        {{-- Jumlah Total --}}
        <fieldset>
            <legend>Jumlah Pendaki</legend>
            <label>Total Pendaki (termasuk ketua):</label>
            <input type="number" name="jumlah_pendaki" min="1" required>
        </fieldset>

        {{-- Submit --}}
        <div class="form-footer">
            <button type="submit">Kirim Booking</button>
            <button type="reset">Batal</button>
        </div>
    </form>

    {{-- Riwayat --}}
    <hr>
    <h3>Riwayat Booking Anda</h3>
    @forelse($booking as $b)
        <div class="riwayat-booking" style="margin-bottom: 20px;">
            <strong>Tanggal:</strong> {{ $b->tanggal_pendakian }}<br>
            <strong>Jumlah Pendaki:</strong> {{ $b->jumlah_pendaki }}<br>
            <strong>Ketua:</strong> {{ $b->nama_ketua }}<br>
            <strong>Status:</strong>
            <strong>Status:</strong>
@if($b->status == 'approve')
    <span style="color: green;">Disetujui</span>
@elseif($b->status == 'decline')
    <span style="color: red;">Ditolak</span>
    @if($b->keterangan)
        <br><strong>Alasan Penolakan:</strong> {{ $b->keterangan }}
    @endif
@else
    <span style="color: orange;">Menunggu</span>
@endif


            {{-- Anggota --}}
            @if($b->anggota && count($b->anggota) > 0)
            <div style="margin-top: 10px;">
                <strong>Anggota:</strong>
                <ul>
                    @foreach($b->anggota as $a)
                        <li>{{ $a->nama }} ({{ $a->jenis_kelamin }}, {{ $a->alamat }}, {{ $a->no_telp }})</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <hr>
    @empty
        <p>Belum ada data booking.</p>
    @endforelse
</div>

{{-- JavaScript untuk cek kuota --}}
<script>
    document.getElementById('tanggal_berangkat').addEventListener('change', function () {
        const selectedDate = this.value;
        const kuotaWarning = document.getElementById('kuotaWarning');
        const kuotaInfo = document.getElementById('kuotaInfo');

        fetch(`/cek-kuota?tanggal=${selectedDate}`)
            .then(res => res.json())
            .then(data => {
                if (data.kuota_penuh) {
                    kuotaWarning.style.display = 'block';
                    kuotaInfo.innerHTML = `<span style="color: red;">Kuota penuh</span>`;
                } else {
                    kuotaWarning.style.display = 'none';
                    kuotaInfo.innerHTML = `Sisa kuota: <strong>${data.sisa_kuota}</strong> dari total <strong>${data.total_kuota}</strong>`;
                }
            });
    });
</script>
@endsection
