@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="jalur-container">
    <h2>{{ $cemoroKandang->jalur_pendakian }}</h2>

    <div class="jalur-content">
        <img src="{{ secure_asset('images/' . $cemoroKandang->gambar) }}" alt="Gambar Jalur" class="jalur-img">

        <div class="jalur-info">
            <p><strong>Alamat:</strong> {{ $cemoroKandang->alamat_jalur }}</p>
            <p class="jalur-deskripsi">{!! nl2br(e($cemoroKandang->deskripsi)) !!}</p>
        </div>
    </div>

    <div class="peta-section">
        <h4>Peta Jalur</h4>
        <img src="{{ secure_asset('images/' . $cemoroKandang->gambar_peta) }}" alt="Peta Jalur" class="peta-img">
    </div>

    <div class="video-section" style="margin-top: 30px; text-align: center;">
        <h4>Video Jalur Pendakian Cemoro Kandang</h4>
        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;">
            <iframe 
                src="https://www.youtube.com/embed/AywxR5ZAhSA" 
                frameborder="0" 
                allowfullscreen 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
            </iframe>
        </div>
    </div>
</div>
@endsection
