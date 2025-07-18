<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cemorokandang_detail', function (Blueprint $table) {
            $table->string('jalur')->default('Cemoro Kandang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cemorokandang_detail', function (Blueprint $table) {
            $table->dropColumn('jalur');
        });
    }
};
