@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pendaki.css') }}">
@endpush

@section('content')
<h2 class="judul-halaman">Pilih Jalur Pendakian Gunung Lawu</h2>

<div class="book-container">
    {{-- Cemoro Kandang --}}
    <div class="book-box">
        <img src="{{ asset('images/cemorokandang.jpg') }}" alt="Cemoro Kandang">
        <h3>Cemoro Kandang</h3>
        <a href="{{ route('booking.cemorokandang.form') }}" class="btn-booking">Booking Sekarang</a>
    </div>

    {{-- Cemoro Sewu --}}
    <div class="book-box">
        <img src="{{ asset('images/cemorosewu.jpg') }}" alt="Cemoro Sewu">
        <h3>Cemoro Sewu</h3>
        <a href="{{ route('booking.cemorosewu.form') }}" class="btn-booking">Booking Sekarang</a>
    </div>

    {{-- Cetho --}}
    <div class="book-box">
        <img src="{{ asset('images/cetho.jpg') }}" alt="Cetho">
        <h3>Cetho</h3>
        <a href="{{ route('booking.cetho.form') }}" class="btn-booking">Booking Sekarang</a>
    </div>
</div>
@endsection
