@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Persiapan Pendakian</h3>

    <p><strong>Jenis:</strong> {{ $persiapan->jenis }}</p>
    <p><strong>Deskripsi:</strong> {{ $persiapan->deskripsi }}</p>

    <a href="{{ route('persiapan.index') }}">Kembali</a>
</div>
@endsection
