@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <h3>Detail Pesona Lawu</h3>

    <p><strong>Judul:</strong> {{ $pesona->judul }}</p>
    <p><strong>Deskripsi:</strong> {!! nl2br(e($pesona->deskripsi)) !!}</p>

    @if($pesona->gambar)
        <p><strong>Gambar:</strong></p>
        <img src="{{ asset('images/' . $pesona->gambar) }}" width="200" alt="Gambar {{ $pesona->judul }}">
    @endif

    <a href="{{ route('pesona.index') }}">Kembali</a>
</div>
@endsection
