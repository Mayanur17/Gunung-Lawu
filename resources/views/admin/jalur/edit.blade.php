@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/jalur.css') }}">
@endpush

@section('content')
<div class="container" style="max-width: 700px; margin: auto; padding: 30px;">
    <h2 style="text-align: center; margin-bottom: 30px;">Edit Jalur: {{ $jalur->jalur_pendakian }}</h2>

    <form action="{{ route('jalur.update', $jalur->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Nama Jalur</label>
            <input type="text" name="jalur_pendakian" value="{{ $jalur->jalur_pendakian }}" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Alamat Jalur</label>
            <input type="text" name="alamat_jalur" value="{{ $jalur->alamat_jalur }}" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required>{{ $jalur->deskripsi }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Gambar Jalur (opsional)</label>
            <input type="file" name="gambar" class="form-control">
            @if($jalur->gambar)
            <img src="{{ secure_asset('images/' . $jalur->gambar) }}" width="150" style="margin-top: 10px;">
            @endif
        </div>

        <div style="margin-bottom: 15px;">
            <label>Gambar Peta (opsional)</label>
            <input type="file" name="gambar_peta" class="form-control">
            @if($jalur->gambar_peta)
            <img src="{{ secure_asset('images/' . $jalur->gambar_peta) }}" width="150" style="margin-top: 10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Jalur</button>
    </form>
</div>
@endsection
