<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    protected $table = 'jalur'; 
    protected $fillable = ['jalur_pendakian', 'gambar', 'alamat_jalur','deskripsi', 'gambar_peta'];
}
