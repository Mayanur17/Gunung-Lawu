<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CeritaPendaki;

class BalasanCerita extends Model
{
    use HasFactory;

    protected $table = 'balasan_cerita';

    protected $fillable = [
        'cerita_id',
        'user_id', 
        'isi',
    ];

    public function cerita()
    {
        return $this->belongsTo(CeritaPendaki::class, 'cerita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
