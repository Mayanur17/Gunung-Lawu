<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeralatanTektok extends Model
{
    protected $table = 'peralatan_tektok'; 
    protected $fillable = ['judul', 'deskripsi', 'gambar'];
}
