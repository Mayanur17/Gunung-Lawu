@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/jalur.css') }}">
@endpush

@section('content')
<div class="kuota-container">
    <h2>Atur Kuota Pendakian - Cetho</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
    <form method="POST" action="{{ route('kuota.cetho.store') }}" class="form-kuota ">
        @csrf
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label for="kuota">Kuota:</label>
        <input type="number" name="kuota" required min="0">

        <button type="submit">Tambah Kuota</button>
    </form>

    <h3>Daftar Kuota</h3>
    <table class="tabel-kuota">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('kuota.cetho.update', $item->id) }}">
                            @csrf
                            <input type="number" name="kuota" value="{{ $item->kuota }}" min="0" required>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('kuota.cetho.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button" onclick="return confirm('Yakin hapus kuota ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
