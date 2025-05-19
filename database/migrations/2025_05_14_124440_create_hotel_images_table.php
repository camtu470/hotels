<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('hotel_images', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('hotel_id');
        $table->string('url');
        $table->timestamps();

        $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
    });
}

};