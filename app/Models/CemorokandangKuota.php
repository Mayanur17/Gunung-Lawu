<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CemorokandangKuota extends Model
{
    protected $table = 'cemorokandang_kuota';

    protected $fillable = ['tanggal', 'kuota'];
}
