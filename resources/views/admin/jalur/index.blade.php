@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/jalur.css') }}">
@endpush

@section('content')
<div class="container">
    <h2 style="text-align: center; margin-bottom: 30px;">Informasi Jalur Pendakian</h2>
    <div style="text-align: center; margin-bottom: 20px;">

    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 30px;">
        @foreach ($data as $jalur)
        <div style="width: 300px; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); background-color: #fff;">
            <img src="{{ secure_asset('images/' . $jalur->gambar) }}" alt="{{ $jalur->jalur_pendakian }}" style="width: 100%; height: 180px; object-fit: cover;">
            <div style="padding: 20px;">
                <h4 style="margin-bottom: 10px;">{{ $jalur->jalur_pendakian }}</h4>
                <p style="font-size: 14px; color: #555; margin-bottom: 10px;"><strong>Alamat:</strong> {{ $jalur->alamat_jalur }}</p>
                <p style="font-size: 14px; color: #555; margin-bottom: 10px;">{{ Str::limit($jalur->deskripsi, 100) }}</p>
                <div class="action-buttons">
    <a href="{{ route('jalur.edit', $jalur->id) }}" class="btn btn-primary">Edit</a>
    @php
    $slug = Str::slug($jalur->jalur_pendakian);
@endphp

<a href="{{ 
    $slug === 'cemoro-kandang' ? route('admin.kuota.cemorokandang') :
    ($slug === 'cemoro-sewu' ? route('admin.kuota.cemorosewu') :
    ($slug === 'cetho' ? route('admin.kuota.cetho') : '#')) 
}}" class="btn btn-success"> Atur Kuota</a>
</div>


            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
