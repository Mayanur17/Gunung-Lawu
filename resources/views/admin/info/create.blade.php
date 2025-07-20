@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Tambah Info Trip Gunung Lawu</h3>

<form action="{{ route('info.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf

    <label>Nama Komunitas:</label>
    <input type="text" name="namakomunitas" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" required></textarea>

    <label>Gambar:</label>
    <input type="file" name="gambar" required>

    <button type="submit">Simpan</button>
</form>
@endsection
