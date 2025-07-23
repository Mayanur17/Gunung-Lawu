@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Edit Info Trip Gunung Lawu</h3>
<div class="table-responsive">
<div class="form-wrapper">
    <form action="{{ route('info.update', $info) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <label>Nama Komunitas:</label>
        <input type="text" name="namakomunitas" value="{{ $info->namakomunitas }}" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required>{{ $info->deskripsi }}</textarea>

        <label>Ganti Gambar (opsional):</label>
        <input type="file" name="gambar">

        <button type="submit">Update</button>
    </form>
</div>
</div>
@endsection
