@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Tambah Peralatan Tektok Gunung Lawu</h3>

<form action="{{ route('peralatantektok.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf

    <label>Judul:</label>
    <input type="text" name="judul" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" required></textarea>

    <label>Gambar:</label>
    <input type="file" name="gambar" required>

    <button type="submit">Simpan</button>
</form>
@endsection
