@extends('layout.app') 
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pendaki.css') }}">
@endpush
@section('content')
<div class="container">
    <h2 class="text-center my-4">Berita Terkini Gunung Lawu</h2>

    @foreach ($berita as $item)
        <div class="card mb-4">
            @if($item->gambar)
                <img src="{{ asset('images/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
            @endif
            <div class="card-body">
                <h4 class="card-title">{{ $item->judul }}</h4>
                <p class="card-text">>{!! nl2br(e($item->deskripsi)) !!}<p>
            </div>
        </div>
    @endforeach
</div>
@endsection
