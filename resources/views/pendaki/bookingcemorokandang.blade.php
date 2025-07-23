@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="booking-container">
    <h2>Form Booking Pendakian - Cemoro Kandang</h2>

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
    <form id="formBooking" action="{{ route('booking.cemorokandang.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jalur" value="Cemoro Kandang">

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

        <fieldset>
            <legend>Data Ketua Rombongan</legend>

            <label>Nama Ketua:</label>
            <input type="text" name="nama_ketua" required>

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir_ketua" max="2008-12-31" required>

            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin_ketua" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label>Alamat:</label>
            <textarea name="alamat_ketua" rows="2" required></textarea>

            <label>No Identitas:</label>
            <input type="text" name="no_identitas_ketua" id="no_identitas_ketua" minlength="9" maxlength="16" pattern="\d{9,16}" title="Isi dengan 9 hingga 16 digit angka" required>

            <label>No HP / WA:</label>
            <input type="text" name="no_telp" maxlength="13" pattern="\d{10,13}" title="Masukkan 10 hingga 13 digit angka" required>

            <label>Email Aktif:</label>
            <input type="email" name="email" id="email" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Gunakan alamat Gmail saja" required>   
            
            <label for="foto_identitas">Upload Foto Identitas (Max 2MB):</label><br>
            <input type="file" name="foto_identitas" id="foto_identitas" accept="image/*" required><br><br>

        </fieldset>

        <fieldset>
            <legend>Data Anggota</legend>
            <p><strong>Format:</strong> Nama, Jenis Kelamin, Alamat, No HP</p>
            <textarea name="anggota" rows="5" placeholder="Contoh:
Budi, Laki-laki, Solo, 0812345678
Sari, Perempuan, Jogja, 0822334455"></textarea>
        </fieldset>

        <fieldset>
            <legend>Jumlah Pendaki</legend>
            <label>Total Pendaki (termasuk ketua):</label>
            <input type="number" name="jumlah_pendaki" min="1" required>
        </fieldset>

        <div class="form-footer">
            <button type="submit" class="btn-submit" id="btnKirimBooking">Kirim Booking</button>
            <button type="reset" class="btn-reset">Batal</button>
        </div>
    </form>

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
             @if($b->keterangan_admin)
             <br><strong>Alasan Penolakan:</strong> {{ $b->keterangan_admin }}
            @endif

            @else
            <span style="color: orange;">Pending</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalPendakian = document.getElementById('tanggal_pendakian');
        const tanggalTurun = document.getElementById('tanggal_turun');
        const kuotaWarning = document.getElementById('kuotaWarning');
        const kuotaInfo = document.getElementById('kuotaInfo');
        const formBooking = document.getElementById('formBooking');
        const inputTelp = document.querySelector('input[name="no_telp"]');
        const identitasInput = document.getElementById('no_identitas_ketua');

        const form = document.querySelector('form');
        const anggotaTextarea = document.querySelector('textarea[name="anggota"]');
        const jumlahPendakiInput = document.querySelector('input[name="jumlah_pendaki"]');

        identitasInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });

        const today = new Date().toISOString().split('T')[0];
        tanggalPendakian.setAttribute('min', today);

        tanggalPendakian.addEventListener('change', function () {
            const selectedDate = this.value;
            if (!selectedDate) return;

            tanggalTurun.value = '';
            tanggalTurun.setAttribute('min', selectedDate);
            const maxDateObj = new Date(selectedDate);
            maxDateObj.setDate(maxDateObj.getDate() + 3);
            const maxDateStr = maxDateObj.toISOString().split('T')[0];
            tanggalTurun.setAttribute('max', maxDateStr);

            fetch(`/cek-kuota-kandang?tanggal=${selectedDate}`)
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

        inputTelp.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });

            const formBooking = document.getElementById('formBooking');

formBooking.addEventListener('submit', function (e) {
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
            const identitas = identitasInput.value;
            if (identitas.length < 9 || identitas.length > 16) {
            alert("No Identitas harus terdiri dari 9 hingga 16 digit angka.");
            e.preventDefault();
            return;
    }
        });
    });
</script>



@endsection
