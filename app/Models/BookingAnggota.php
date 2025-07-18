<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAnggota extends Model
{
    protected $table = 'booking_anggota';

    protected $fillable = [
        'booking_id',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telp',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingDetail::class, 'booking_id');
    }
}
