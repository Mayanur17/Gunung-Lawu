<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuotaPendakian extends Model
{
    protected $table = 'kuota_pendakian';

    protected $fillable = ['tanggal', 'kuota'];
}
