@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Edit Berita Terkini</h3>

<div class="form-wrapper">
    <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <label>Judul:</label>
        <input type="text" name="judul" value="{{ $berita->judul }}" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required>{{ $berita->deskripsi }}</textarea>

        <label>Gambar Saat Ini:</label>
        @if($berita->gambar)
            <div style="margin-bottom: 10px;">
                <img src="{{ $berita->gambar }}" alt="gambar" style="width: 150px; border-radius: 5px;">
            </div>
        @endif

        <label>Ganti Gambar (opsional):</label>
        <input type="file" name="gambar">

        <button type="submit">Update</button>
    </form>
</div>
@endsection
