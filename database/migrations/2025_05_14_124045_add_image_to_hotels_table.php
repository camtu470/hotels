<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('image')->nullable()->after('address'); // hoặc vị trí khác tùy bạn
        });
    }
    
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};