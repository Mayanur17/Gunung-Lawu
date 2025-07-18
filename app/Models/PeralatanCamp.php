<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeralatanCamp extends Model
{
    protected $table = 'peralatan_camp'; 
    protected $fillable = ['judul', 'deskripsi', 'gambar'];
}
