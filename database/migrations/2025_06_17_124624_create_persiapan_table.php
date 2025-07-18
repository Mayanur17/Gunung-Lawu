<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersiapanTable extends Migration
{
    public function up()
    {
        Schema::create('persiapan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');        
            $table->text('deskripsi');     
            $table->timestamps();           
        });
    }

    public function down()
    {
        Schema::dropIfExists('persiapan');
    }
}
