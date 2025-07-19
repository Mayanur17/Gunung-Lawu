<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemorosewuDetailTable extends Migration
{
    public function up()
    {
        Schema::create('cemorosewu_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->date('tanggal_pendakian');
            $table->date('tanggal_turun');
            $table->enum('keterangan', ['Tektok', 'Camp']);
            $table->string('jalur')->default('Cemoro Sewu'); 
            $table->integer('jumlah_pendaki');
            $table->string('nama_ketua');
            $table->date('tanggal_lahir_ketua');
            $table->string('jenis_kelamin_ketua');
            $table->text('alamat_ketua');
            $table->string('no_identitas_ketua');
            $table->string('no_telp');
            $table->string('email');
            $table->string('foto_identitas')->nullable();
            $table->enum('status', ['pending', 'approve', 'decline'])->default('pending');
            $table->text('keterangan_admin')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cemorosewu_detail');
    }
}
