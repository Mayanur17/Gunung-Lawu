@extends('layout.app') 
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pendaki.css') }}">
@endpush
@section('content')
<div class="container">
    <h2 class="text-center my-4">Peralatan TekTok</h2>

    @foreach ($peralatantektok as $item)
        <div class="card mb-4">
            @if($item->gambar)
                <img src="{{ asset('images/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
            @endif
            <div class="card-body">
                <h4 class="card-title">{{ $item->judul }}</h4>
                <p class="card-text">{{ $item->deskripsi }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
