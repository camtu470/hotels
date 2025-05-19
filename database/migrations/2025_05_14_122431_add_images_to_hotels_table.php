<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('images')->nullable(); // Thêm cột `images` dưới dạng JSON
        });
    }
    
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('images'); // Xóa cột `images`
        });
    }
    
    
};