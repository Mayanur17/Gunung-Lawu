@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/pendaki.css') }}">
@endpush

@section('content')
<div class="cerita-wrapper">
    <h2>Cerita Pendaki</h2>

    <form class="cerita-form" action="{{ route('cerita.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="isi" rows="4" placeholder="Bagikan ceritamu..." required></textarea>
        <input type="file" name="gambar" accept="image/*">
        <button type="submit">Kirim Cerita</button>
    </form>

    <hr>

    @foreach($cerita as $item)
        <div class="story-item">
            <strong>{{ $item->user->name ?? 'Anonim' }}</strong><br>
            @if($item->gambar)
            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Foto Cerita" style="max-width: 100%; height: auto;">
            @endif
            <p>{{ $item->isi }}</p>

            <div class="story-komentar">
                <h5>Komentar:</h5>
                @foreach($item->balasan as $balas)
                    <p><strong>{{ $balas->user->name ?? 'Anonim' }}:</strong> 👉 {{ $balas->isi }}</p>
                @endforeach

                {{-- Form balasan --}}
                <form action="{{ route('cerita.balas', $item->id) }}" method="POST">
                    @csrf
                    <input type="text" name="isi" placeholder="Balas cerita ini..." required>
                    <button type="submit">Balas</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection. 