@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h2>Data Peralatan Camp</h2>
<a href="{{ route('peralatancamp.create') }}" class="tombol-tambah">+ Tambah Peralatan</a>
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
            <td>
                @if($item->gambar)
                    <img src="{{ secure_asset('images/' . $item->gambar) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('peralatancamp.show', $item->id) }}">Lihat</a> |
                <a href="{{ route('peralatancamp.edit', $item->id) }}">Edit</a>
                <form action="{{ route('peralatancamp.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
