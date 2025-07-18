<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CethoDetail extends Model
{
    use HasFactory;

    protected $table = 'cetho_detail';

    protected $fillable = [
        'user_id',
        'tanggal_pendakian',
        'tanggal_turun',
        'keterangan',
        'jalur',
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
        'keterangan_admin'
    ];

    public function anggota()
    {
        return $this->hasMany(CethoAnggota::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
