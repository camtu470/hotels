<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('promotions', function (Blueprint $table) {
        $table->id();
        $table->string('code');
        $table->text('description');
        $table->decimal('discount_value', 8, 2);
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['active', 'inactive']);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};