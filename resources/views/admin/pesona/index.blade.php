@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h2>Data Pesona Gunung Lawu</h2>
<a href="{{ route('pesona.create') }}" class="tombol-tambah">+ Tambah Pesona</a>
<div class="table-responsive">
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->judul }}</td>
            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
            <td><img src="{{ asset('storage/images' . $item->gambar) }}" width="100">
            <td>
                <a href="{{ route('pesona.show', $item->id) }}">Lihat</a> 
                <a href="{{ route('pesona.edit', $item->id) }}">Edit</a>
                <form action="{{ route('pesona.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                    @csrf
                    @method('DELETE')
                    <button>Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
