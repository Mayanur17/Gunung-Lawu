<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CethoAnggota extends Model
{
    use HasFactory;

    protected $table = 'cetho_anggota';

    protected $fillable = [
        'booking_id',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telp',
    ];

    public function booking()
    {
        return $this->belongsTo(CethoDetail::class, 'booking_id');
    }
}
