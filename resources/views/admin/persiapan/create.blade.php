@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Tambah Persiapan Pendakian Gunung Lawu</h3>

<form action="{{ route('persiapan.store') }}" method="POST" class="admin-form">
    @csrf

    <label>Jenis Persiapan:</label>
    <input type="text" name="jenis" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" required></textarea>

    <button type="submit">Simpan</button>
</form>
@endsection
