<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CethoKuota extends Model
{
    protected $table = 'cetho_kuota';

    protected $fillable = ['tanggal', 'kuota'];
}
