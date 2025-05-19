<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE rooms MODIFY COLUMN status ENUM('available', 'unavailable', 'use') NOT NULL");
    }

    public function down()
    {
        // Nếu rollback, quay lại enum ban đầu
        DB::statement("ALTER TABLE rooms MODIFY COLUMN status ENUM('available', 'unavailable') NOT NULL");
    }
};