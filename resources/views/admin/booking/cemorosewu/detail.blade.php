@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="admin-booking-detail">
    <h2>Detail Booking</h2>

    <p><strong>Jalur:</strong> {{ $booking->jalur ?? '-' }}</p>
<p><strong>Tanggal Pendakian:</strong> {{ $booking->tanggal_pendakian }}</p>
<p><strong>Tanggal Turun:</strong> {{ $booking->tanggal_turun ?? '-' }}</p>
<p><strong>Jenis Pendakian:</strong> {{ $booking->keterangan ?? '-' }}</p>
<p><strong>Jumlah Pendaki:</strong> {{ $booking->jumlah_pendaki }}</p>
<p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
<p><strong>keterangan Admin (jika ditolak):</strong> {{ $booking->keterangan_admin ?? '-' }}</p>
    <h3>Data Ketua</h3>
    <ul>
        <li><strong>Nama:</strong> {{ $booking->nama_ketua }}</li>
        <li><strong>Tanggal Lahir:</strong> {{ $booking->tanggal_lahir_ketua }}</li>
        <li><strong>Jenis Kelamin:</strong> {{ $booking->jenis_kelamin_ketua }}</li>
        <li><strong>Alamat:</strong> {{ $booking->alamat_ketua }}</li>
        <li><strong>No Identitas:</strong> {{ $booking->no_identitas_ketua }}</li>
        <li><strong>No HP:</strong> {{ $booking->no_telp }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Foto Identitas:</strong><br>
            @if($booking->foto_identitas)
                <img src="{{ secure_asset('storage/' . $booking->foto_identitas) }}" width="200">
            @else
                Tidak ada
            @endif
        </li>
    </ul>

    <h3>Anggota</h3>
    <ul>
        @forelse($booking->anggota as $a)
            <li>{{ $a->nama }} - {{ $a->jenis_kelamin }}, {{ $a->alamat }}, {{ $a->no_telp }}</li>
        @empty
            <li>Tidak ada anggota tambahan</li>
        @endforelse
    </ul>
</div>
@endsection
