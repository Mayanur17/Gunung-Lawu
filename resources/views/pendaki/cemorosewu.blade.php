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
<div class="maps-section">
    <h4>Lokasi Basecamp di Google Maps</h4>
    <div class="map-embed" style="width: 100%; height: 400px;">
        @php
            $jalurNama = strtolower($jalur->jalur_pendakian);
        @endphp

        @if($jalurNama === 'cemoro kandang')
        <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63272.044246203346!2d111.14243932586993!3d-7.628953230059511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798c1ae031bb7f%3A0x913104fec197ca69!2sBase%20Camp%20AGL%20Cemoro%20Kandang%2C%20Gn.%20Lawu!5e0!3m2!1sid!2sid!4v1753271268430!5m2!1sid!2sid" 
    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
    </iframe>

        @elseif($jalurNama === 'cemoro sewu')
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63272.09573280656!2d111.14243909593917!3d-7.628605137029124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798df1913548dd%3A0xe95d6dcbaf046c67!2sCemoro%20Sewu!5e0!3m2!1sid!2sid!!5m2!1sid!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        @elseif($jalurNama === 'cetho')
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.8124347841735!2d111.15374597319109!3d-7.595382525054982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798b673d72a09d%3A0xae4de0b35464ae7!2sBasecamp%20Lawu%20via%20Ceto%20(Barokah)!5e0!3m2!1sid!2sid!4v1753273044059!5m2!1sid!2sid" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        @else
            <p style="color:red;">Peta tidak tersedia untuk jalur ini.</p>
        @endif
    </div>
</div>
@endsection