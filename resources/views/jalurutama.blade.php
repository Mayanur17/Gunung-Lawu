@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/jalur.css') }}">
@endpush

@section('content')
<h2 class="judul-halaman">Jalur Pendakian Gunung Lawu</h2>

<div class="jalur-container">
        @auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('jalur.index') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cemorokandang.jpg') }}" alt="Cemoro Kandang">
            <h3>Cemoro Kandang</h3>
        </a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.cemorokandang') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cemorokandang.jpg') }}" alt="Cemoro Kandang">
            <h3>Cemoro Kandang</h3>
        </a>
    @endif
@else
    <a href="#" class="jalur-box">
        <img src="{{ secure_asset('images/cemorokandang.jpg') }}" alt="Cemoro Kandang">
        <h3>Cemoro Kandang</h3>
    </a>
@endauth
@auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('jalur.index') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cemorosewu.jpg') }}" alt="Cemoro Sewu">
            <h3>Cemoro Sewu</h3>
        </a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.cemorosewu') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cemorosewu.jpg') }}" alt="Cemoro Sewu">
            <h3>Cemoro Sewu</h3>
        </a>
    @endif
@else
    <a href="#" class="jalur-box">
        <img src="{{ secure_asset('images/cemorosewu.jpg') }}" alt="Cemoro Sewu">
        <h3>Cemoro Sewu</h3>
    </a>
@endauth

        @auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('jalur.index') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cetho.jpg') }}" alt="Cetho">
            <h3>Cetho</h3>
        </a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.cetho') }}" class="jalur-box">
            <img src="{{ secure_asset('images/cetho.jpg') }}" alt="Cetho">
            <h3>Cetho</h3>
        </a>
    @endif
@else
    <a href="#" class="jalur-box">
        <img src="{{ secure_asset('images/cetho.jpg') }}" alt="Cetho">
        <h3>Cetho</h3>
    </a>
@endauth

</div>
@endsection
