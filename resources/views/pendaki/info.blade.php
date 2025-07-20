@extends('layout.app') 
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush
@section('content')
<div class="container">
    <h2 class="text-center my-4">Info Trip</h2>

    @foreach ($info as $item)
        <div class="card mb-4">
            @if($item->gambar)
                <img src="{{ secure_asset('images/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->namakomunitas }}">
            @endif
            <div class="card-body">
                <h4 class="card-title">{{ $item->namakomunitas }}</h4>
                <p class="card-text">>{!! nl2br(e($item->deskripsi)) !!}<p>
            </div>
        </div>
    @endforeach
</div>
@endsection
