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

            <a href="{{ route('booking.cemorokandang.form') }}" class="btn-booking">
                <i class="fas fa-calendar-check"></i> Booking Sekarang
            </a>
        </div>
    </div>

    <div class="peta-section">
        <h4>Peta Jalur</h4>
        <img src="{{ secure_asset('images/' . $jalur->gambar_peta) }}" alt="Peta Jalur" class="peta-img">
    </div>
</div>

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
