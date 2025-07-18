<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesonaLawu extends Model
{
    protected $table = 'pesona_lawu'; 

    protected $fillable = ['judul', 'deskripsi', 'gambar'];
}
