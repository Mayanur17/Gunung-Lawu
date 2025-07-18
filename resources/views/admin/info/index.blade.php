@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<h2>Data Info Trip</h2>
<a href="{{ route('info.create') }}" class="tombol-tambah">+ Tambah Info</a>
<div class="table-responsive">
<table>
    <thead>
        <tr>
            <th>Nama Komunitas</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->namakomunitas }}</td>
            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
            <td>
                @if($item->gambar)
                    <img src="{{ asset('images/' . $item->gambar) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('info.show', $item->id) }}">Lihat</a> |
                <a href="{{ route('info.edit', $item->id) }}">Edit</a>
                <form action="{{ route('info.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
