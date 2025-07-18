<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemorokandangAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('cemorokandang_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); // Relasi ke detail booking
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();

            // Foreign key ke tabel cemorokandang_details
            $table->foreign('booking_id')->references('id')->on('cemorokandang_detail')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cemorokandang_anggota');
    }
}
