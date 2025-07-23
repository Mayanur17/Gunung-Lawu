@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Info Komunitas</h3>

    <p><strong>Nama Komunitas:</strong> {{ $info->namakomunitas }}</p>
    <p><strong>Deskripsi:</strong> {!! nl2br(e($info->deskripsi)) !!}</p>

    @if($info->gambar)
        <p><strong>Gambar:</strong></p>
        <img src="{{ secure_asset('images/' . $info->gambar) }}" width="200">
    @endif

    <a href="{{ route('info.index') }}">Kembali</a>
</div>
@endsection
