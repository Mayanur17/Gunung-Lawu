<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJalurTable extends Migration
{
    public function up()
    {
        Schema::create('jalur', function (Blueprint $table) {
            $table->id();
            $table->string('jalur_pendakian');
            $table->string('gambar')->nullable();
            $table->string('alamat_jalur');
            $table->text('deskripsi');
            $table->string('gambar_peta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jalur');
    }
}
