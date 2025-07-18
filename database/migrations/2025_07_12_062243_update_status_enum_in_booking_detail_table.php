<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE booking_detail MODIFY status ENUM('menunggu', 'approve', 'decline') DEFAULT 'menunggu'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE booking_detail MODIFY status ENUM('menunggu', 'approve') DEFAULT 'menunggu'");
    }
};
