@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<h2>Data Berita</h2>
<a href="{{ route('berita.create') }}" class="tombol-tambah">+ Tambah Berita</a>
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
            <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}</td>
            <td>
                @if($item && $item->gambar)
                <img src="{{ route('berita.gambar', $item->id) }}" alt="Gambar" width="100">
                @else
                    Tidak ada gambar
                @endif
            </td>
            <td>
                <a href="{{ route('berita.show', $item->id) }}">Lihat</a> |
                <a href="{{ route('berita.edit', $item->id) }}">Edit</a>
                <form action="{{ route('berita.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
