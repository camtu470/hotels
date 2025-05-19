<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('image'); // Xóa cột 'image'
        });
    }
    
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('image')->nullable(); // Khôi phục cột 'image' nếu cần
        });
    }
    
    
};