@extends('layout.app') 
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pendaki.css') }}">
@endpush
@section('content')
<div class="container">
    <h2 class="text-center">Persiapan Pendakian</h2>

    <div class="persiapan-list">
        @foreach($persiapan as $item)
            <div class="persiapan-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">
                <h4>{{ $item->jenis }}</h4>
                <p>{!! nl2br(e($item->deskripsi)) !!}<p>
            </div>
        @endforeach
    </div>
</div>
@endsection
