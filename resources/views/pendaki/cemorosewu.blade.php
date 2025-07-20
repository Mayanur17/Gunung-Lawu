@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="jalur-container">
    <h2>{{ $jalur->jalur_pendakian }}</h2>

    <div class="jalur-content">
        <img src="{{ secure_asset('images/' . $jalur->gambar) }}" alt="Gambar Jalur" class="jalur-img">

    <div class="jalur-info">
        <p><strong>Alamat:</strong> {{ $jalur->alamat_jalur }}</p>
        <p class="jalur-deskripsi">{!! nl2br(e($jalur->deskripsi)) !!}</p>

        {{-- Booking berdasarkan nama jalur --}}
        @php
            $jalurNama = strtolower($jalur->jalur_pendakian);
        @endphp

        @if($jalurNama === 'cemoro kandang')
            <a href="{{ route('booking.cemorokandang.form') }}" class="btn-booking">
                <i class="fas fa-calendar-check"></i> Booking Sekarang
            </a>
        @elseif($jalurNama === 'cetho')
            <a href="{{ route('booking.cetho.form') }}" class="btn-booking">
                <i class="fas fa-calendar-check"></i> Booking Sekarang
            </a>
        @elseif($jalurNama === 'cemoro sewu')
            <a href="{{ route('booking.cemorosewu.form') }}" class="btn-booking">
                <i class="fas fa-calendar-check"></i> Booking Sekarang
            </a>
        @else
            <p style="color:red;">Form booking tidak tersedia untuk jalur ini.</p>
        @endif
    </div>
</div>

    </div>

    <div class="peta-section">
        <h4>Peta Jalur</h4>
        <img src="{{ secure_asset('images/' . $jalur->gambar_peta) }}" alt="Peta Jalur" class="peta-img">
    </div>
</div>

@if(strtolower($jalur->jalur_pendakian) === 'cemoro sewu')
<div class="video-section">
    <h4>Video Jalur Pendakian via Cemoro Sewu</h4>
    <div class="video-grid">
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/4kMW4eB5aWs" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/CMo6bDZzu_c" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/C5nVHZpZTL8" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endif

@if(strtolower($jalur->jalur_pendakian) === 'cemoro kandang')
<div class="video-section">
    <h4>Video Jalur Pendakian via Cemoro Kandang</h4>
    <div class="video-grid">
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/AywxR5ZAhSA" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/Xt8lJlxNiH4" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/63TWd7C_DeQ" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endif
@if(strtolower($jalur->jalur_pendakian) === 'cetho')
    <div class="video-section">
        <h4>Video Jalur Pendakian via Cetho</h4>
        <div class="video-grid">
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/W702b2AWfXQ" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/qG1LRzqN3BQ" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/pBXE0bgYj_8" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endif
@endsection