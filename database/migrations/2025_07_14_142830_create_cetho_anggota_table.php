<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCethoAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('cetho_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); 
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();


            $table->foreign('booking_id')->references('id')->on('cetho_detail')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cetho_anggota');
    }
}
