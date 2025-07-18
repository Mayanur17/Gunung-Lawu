<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'booking_detail';

    protected $fillable = [
        'user_id',
        'tanggal_pendakian',
        'jumlah_pendaki',
        'nama_ketua',
        'tanggal_lahir_ketua',
        'jenis_kelamin_ketua',
        'alamat_ketua',
        'no_identitas_ketua',
        'no_telp',
        'email',
        'foto_identitas',
        'status',
    ];

    public function anggota()
    {
        return $this->hasMany(BookingAnggota::class, 'booking_id');
    }
}