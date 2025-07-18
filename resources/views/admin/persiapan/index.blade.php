@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush
<div class="table-responsive">
@section('content')
<h2>Data Persiapan Pendakian Gunung Lawu</h2>
<a href="{{ route('persiapan.create') }}"class="tombol-tambah">+ Tambah Persiapan</a>
<table>
    <thead>
        <tr>
            <th>Jenis</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->jenis }}</td>
            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
            <td>
                <a href="{{ route('persiapan.show', $item->id) }}">Lihat</a> 
                <a href="{{ route('persiapan.edit', $item->id) }}">Edit</a>
                <form action="{{ route('persiapan.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
