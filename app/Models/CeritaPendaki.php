<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BalasanCerita;

class CeritaPendaki extends Model
{
    use HasFactory;

    protected $table = 'cerita_pendaki';

    protected $fillable = [
        'user_id',
        'isi',
        'gambar',
    ];

    // Relasi: satu cerita punya banyak balasan
    public function balasan()
    {
        return $this->hasMany(BalasanCerita::class, 'cerita_id');
    }

    // Relasi: satu cerita dibuat oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
