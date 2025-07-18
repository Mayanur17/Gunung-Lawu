@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Berita</h3>

    <p><strong>Judul:</strong> {{ $berita->judul }}</p>
    <p><strong>Deskripsi:</strong> {{ $berita->deskripsi }}</p>

    @if($berita->gambar)
        <p><strong>Gambar:</strong></p>
        <img src="{{ asset('images/' . $berita->gambar) }}" width="200">
    @endif

    <a href="{{ route('berita.index') }}">Kembali</a>
</div>
@endsection
