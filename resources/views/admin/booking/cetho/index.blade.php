@extends('layout.app')
@push('styles')
<link rel="stylesheet" href="{{ secure_asset('css/admin.css') }}">
@endpush

@section('content')
<div class="admin-booking-container">
    <h2>Daftar Booking Pendakian Cetho</h2>

    @if(session('success')) <div class="glw-alert-success">{{ session('success') }}</div> @endif

    <table class="glw-table-booking">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Pendaki</th>
                <th>Ketua</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $b->tanggal_pendakian }}</td>
                <td>{{ $b->jumlah_pendaki }}</td>
                <td>{{ $b->nama_ketua }}</td>
                <td>
                    @if($b->status == 'approve')
                        <span style="color: green;">Disetujui</span>
                    @elseif($b->status == 'decline')
                        <span style="color: red;">Ditolak</span>
                    @else
                        <span style="color: orange;">Menunggu</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('booking.cetho.detail', $b->id) }}" class="btn-detail">Detail</a>

                    @if($b->status != 'approve' && $b->status != 'decline')
                        <form action="{{ route('booking.cetho.approve', $b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-approve">Setujui</button>
                        </form>

                        <form action="{{ route('booking.cetho.decline', $b->id) }}" method="POST" style="display:inline;" onsubmit="return confirmTolak(this);">
                            @csrf
                            <input type="hidden" name="alasan" value="">
                            <button type="submit" class="btn-decline">Tolak</button>
                        </form>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada data booking.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- JS Prompt untuk menolak --}}
<script>
function confirmTolak(form) {
    const reason = prompt("Masukkan alasan penolakan:");
    if (reason) {
        form.querySelector('input[name="alasan"]').value = reason;
        return true;
    }
    return false;
}
</script>
@endsection
