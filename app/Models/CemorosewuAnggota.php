<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CemorosewuAnggota extends Model
{
    use HasFactory;

    protected $table = 'cemorosewu_anggota';

    protected $fillable = [
        'booking_id',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telp',
    ];

    public function booking()
    {
        return $this->belongsTo(CemorosewuDetail::class, 'booking_id');
    }
}
