@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Peralatan Camp</h3>

    <p><strong>Judul:</strong> {{ $peralatancamp->judul }}</p>
    <p><strong>Deskripsi:</strong> {{ $peralatancamp->deskripsi }}</p>

    @if($peralatancamp->gambar)
        <p><strong>Gambar:</strong></p>
        <img src="{{ secure_asset('images/' . $peralatancamp->gambar) }}" width="200">
    @endif

    <a href="{{ route('peralatancamp.index') }}">Kembali</a>
</div>
@endsection
