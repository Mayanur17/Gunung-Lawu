@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h3>Edit Persiapan Pendakian Gunung Lawu</h3>
<div class="form-wrapper">
<form action="{{ route('persiapan.update', $persiapan->id) }}" method="POST" class="admin-form">
    @csrf
    @method('PUT')

    <label>Jenis Persiapan:</label>
    <input type="text" name="jenis" value="{{ $persiapan->jenis }}" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" required>{{ $persiapan->deskripsi }}</textarea>

    <button type="submit">Update</button>
</form>
</div>
@endsection
