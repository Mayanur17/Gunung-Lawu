<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemorosewuAnggotaTable extends Migration
{
    public function up()
    {
        Schema::create('cemorosewu_anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); 
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();


            $table->foreign('booking_id')->references('id')->on('cemorosewu_detail')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cemorosewu_anggota');
    }
}
