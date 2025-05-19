<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomIdToAmenitiesTable extends Migration
{
    public function up()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable(); // Hoặc không nullable nếu muốn bắt buộc
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
    
}