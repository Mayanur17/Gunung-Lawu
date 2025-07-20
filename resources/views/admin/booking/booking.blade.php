@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<h2 class="judul-halaman">Kelola Booking Jalur Pendakian Gunung Lawu</h2>

<div class="book-container">
    {{-- Cemoro Kandang --}}
    <div class="book-box">
        <img src="{{ secure_asset('images/cemorokandang.jpg') }}" alt="Cemoro Kandang">
        <h3>Cemoro Kandang</h3>
        <a href="{{ route('admin.booking.cemorokandang.index') }}" class="btn-booking">Kelola Booking</a>
    </div>

    {{-- Cemoro Sewu --}}
    <div class="book-box">
        <img src="{{ secure_asset('images/cemorosewu.jpg') }}" alt="Cemoro Sewu">
        <h3>Cemoro Sewu</h3>
        <a href="{{ route('admin.booking.cemorosewu.index') }}" class="btn-booking">Kelola Booking</a>
    </div>

    {{-- Cetho --}}
    <div class="book-box">
        <img src="{{ secure_asset('images/cetho.jpg') }}" alt="Cetho">
        <h3>Cetho</h3>
        <a href="{{ route('admin.booking.cetho.index') }}" class="btn-booking">Kelola Booking</a>
    </div>
</div>
@endsection
