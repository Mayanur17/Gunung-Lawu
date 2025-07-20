@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="booking-container">
    <h2>Form Booking Pendakian - Cetho</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0; padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('booking.cetho.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jalur" value="Cetho">

        {{-- Tanggal --}}
        <fieldset>
            <legend>Informasi Pendakian</legend>

            <label for="tanggal_pendakian">Tanggal Pendakian:</label>
            <input type="date" name="tanggal_pendakian" id="tanggal_pendakian" required>

            <label for="tanggal_turun">Tanggal Turun:</label>
            <input type="date" name="tanggal_turun" id="tanggal_turun" required>

            <label for="keterangan">Jenis Pendakian:</label>
            <select name="keterangan" required>
                <option value="">Pilih</option>
                <option value="Tektok">Tektok</option>
                <option value="Camp">Camp</option>
            </select>

            <div id="kuotaInfo" style="font-size: 14px; margin-top: 5px;"></div>
            <small id="kuotaWarning" style="color:red; display:none;">Kuota penuh untuk tanggal ini!</small>
        </fieldset>

        {{-- Ketua --}}
        <fieldset>
            <legend>Data Ketua Rombongan</legend>

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
            <textarea name="alamat_ketua" rows="2" required></textarea>
            <label>No Identitas:</label>
            <input type="text" name="no_identitas_ketua" id="no_identitas_ketua" maxlength="20" pattern="\d+" title="Hanya angka yang diperbolehkan" required>

            <label>No HP / WA:</label>
            <input type="text" name="no_telp" maxlength="13" pattern="\d{10,13}" title="Masukkan 10 hingga 13 digit angka" required>

            <label>Email Aktif:</label>
            <input type="email" name="email" id="email" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Gunakan alamat Gmail saja" required>

            <label>Upload Foto Identitas (Max 2MB):</label>
            <input type="file" name="foto_identitas" accept="image/*">
        </fieldset>

        {{-- Anggota --}}
        <fieldset>
            <legend>Data Anggota</legend>
            <p><strong>Format:</strong> Nama, Jenis Kelamin, Alamat, No HP</p>
            <textarea name="anggota" rows="5" placeholder="Contoh:
Budi, Laki-laki, Solo, 0812345678
Sari, Perempuan, Jogja, 0822334455"></textarea>
        </fieldset>

        {{-- Jumlah --}}
        <fieldset>
            <legend>Jumlah Pendaki</legend>
            <label>Total Pendaki (termasuk ketua):</label>
            <input type="number" name="jumlah_pendaki" min="1" required>
        </fieldset>

        {{-- Tombol --}}
        <div class="form-footer">
            <button type="submit" class="btn-submit" id="btnKirimBooking">Kirim Booking</button>
            <button type="reset" class="btn-reset">Batal</button>

        </div>
    </form>

    {{-- Riwayat --}}
    <hr>
    <h3>Riwayat Booking Anda</h3>
    @forelse($booking as $b)
        <div class="riwayat-booking" style="margin-bottom: 20px;">
            <strong>Nama Ketua:</strong> {{ $b->nama_ketua }}<br>
            <strong>Tanggal Naik:</strong> {{ $b->tanggal_pendakian }}<br>
            <strong>Tanggal Turun:</strong> {{ $b->tanggal_turun ?? '-' }}<br>
            <strong>Jalur:</strong> {{ $b->jalur }}<br>
            <strong>Jenis Pendakian:</strong> {{ $b->keterangan }}<br>
            <strong>Jumlah Pendaki:</strong> {{ $b->jumlah_pendaki }}<br>
            <strong>Status:</strong>
            @if($b->status == 'approve')
                <span style="color: green;">Disetujui</span>
            @elseif($b->status == 'decline')
                <span style="color: red;">Ditolak</span>
                @if($b->keterangan)
                    <br><strong>Alasan Penolakan:</strong> {{ $b->keterangan-admin }}
                @endif
            @else
                <span style="color: orange;">Menunggu</span>
            @endif

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

{{-- JS Cek Kuota --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalPendakian = document.getElementById('tanggal_pendakian');
        const tanggalTurun = document.getElementById('tanggal_turun');
        const kuotaWarning = document.getElementById('kuotaWarning');
        const kuotaInfo = document.getElementById('kuotaInfo');
        const kirimButton = document.getElementById('btnKirimBooking');
        const inputTelp = document.querySelector('input[name="no_telp"]');
        const identitasInput = document.getElementById('no_identitas_ketua');

        const form = document.querySelector('form');
        const anggotaTextarea = document.querySelector('textarea[name="anggota"]');
        const jumlahPendakiInput = document.querySelector('input[name="jumlah_pendaki"]');

        // Validasi hanya angka untuk identitas
        identitasInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });

        // Set tanggal minimal pendakian hari ini
        const today = new Date().toISOString().split('T')[0];
        tanggalPendakian.setAttribute('min', today);

        // Ketika tanggal pendakian diubah
        tanggalPendakian.addEventListener('change', function () {
            const selectedDate = this.value;
            if (!selectedDate) return;

            // Atur batas tanggal turun
            tanggalTurun.value = '';
            tanggalTurun.setAttribute('min', selectedDate);
            const maxDateObj = new Date(selectedDate);
            maxDateObj.setDate(maxDateObj.getDate() + 3);
            const maxDateStr = maxDateObj.toISOString().split('T')[0];
            tanggalTurun.setAttribute('max', maxDateStr);

            // Ambil kuota dari server
            fetch(`/cek-kuota-cetho?tanggal=${selectedDate}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.total_kuota) {
                        kuotaWarning.style.display = 'block';
                        kuotaWarning.innerHTML = `<span style="color: orange;">Kuota belum tersedia. Silakan pilih tanggal lain.</span>`;
                        kuotaInfo.innerHTML = '';
                        kirimButton.disabled = true;
                        kirimButton.style.opacity = 0.6;
                    } else if (data.kuota_penuh) {
                        kuotaWarning.style.display = 'block';
                        kuotaWarning.innerHTML = `<span style="color: red;">Kuota penuh</span>`;
                        kuotaInfo.innerHTML = `Total kuota: <strong>${data.total_kuota}</strong>`;
                        kirimButton.disabled = true;
                        kirimButton.style.opacity = 0.6;
                    } else {
                        kuotaWarning.style.display = 'none';
                        kuotaWarning.innerHTML = '';
                        kuotaInfo.innerHTML = `Sisa kuota: <strong>${data.sisa_kuota}</strong> dari total <strong>${data.total_kuota}</strong>`;
                        kirimButton.disabled = false;
                        kirimButton.style.opacity = 1;
                    }
                })
                .catch(error => {
                    console.error('Gagal mengambil data kuota:', error);
                    kuotaWarning.style.display = 'block';
                    kuotaWarning.innerHTML = `<span style="color: red;">Kuota belum tersedia. Silakan pilih tanggal lain.</span>`;
                    kuotaInfo.innerHTML = '';
                    kirimButton.disabled = true;
                    kirimButton.style.opacity = 0.6;
                });
        });

        // Validasi no HP hanya angka, max 13 digit
        inputTelp.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });

        // Validasi saat submit form
        form.addEventListener('submit', function (e) {
            let anggotaText = anggotaTextarea.value.trim();
            let jumlahPendaki = parseInt(jumlahPendakiInput.value);

            if (anggotaText === '') {
                alert("Data anggota tidak boleh kosong.");
                e.preventDefault();
                return;
            }

            if (jumlahPendaki < 2) {
                alert("Jumlah pendaki minimal 2 orang (termasuk ketua).");
                e.preventDefault();
                return;
            }

            let anggotaLines = anggotaText.split('\n');
            let formatSalah = false;

            for (let line of anggotaLines) {
                let parts = line.split(',');
                if (parts.length !== 4) {
                    formatSalah = true;
                    break;
                }
                for (let part of parts) {
                    if (part.trim() === '') {
                        formatSalah = true;
                        break;
                    }
                }
                if (formatSalah) break;
            }

            if (formatSalah) {
                alert("Format penulisan anggota salah. Gunakan format: Nama, Jenis Kelamin, Alamat, No HP");
                e.preventDefault();
                return;
            }
        });
    });
</script>
@endsection
