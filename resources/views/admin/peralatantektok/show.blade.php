@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Peralatan TekTok</h3>

    <p><strong>Judul:</strong> {{ $peralatantektok->judul }}</p>
    <p><strong>Deskripsi:</strong> {{ $peralatantektok->deskripsi }}</p>

    @if($peralatantektok->gambar)
        <p><strong>Gambar:</strong></p>
        <img src="{{ secure_asset('images/' . $peralatantektok->gambar) }}" width="200">
    @endif

    <a href="{{ route('peralatantektok.index') }}">Kembali</a>
</div>
@endsection
