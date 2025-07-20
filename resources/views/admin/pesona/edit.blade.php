@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Edit Pesona Gunung Lawu</h3>
<div class="form-wrapper">
<form action="{{ route('pesona.update', $pesona->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf
    @method('PUT')

    <label>Judul:</label>
    <input type="text" name="judul" value="{{ $pesona->judul }}" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" required>{{ $pesona->deskripsi }}</textarea>

    <label>Ganti Gambar (opsional):</label>
    <input type="file" name="gambar">

    <button type="submit">Update</button>
</form>
</div>
@endsection
