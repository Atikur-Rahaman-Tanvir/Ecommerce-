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
        Schema::create('order__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order__summery_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('price');
            $table->integer('quentity')->default('1');
            $table->integer('total');
            $table->foreign('order__summery_id')->references('id')->on('order__summeries')->onDelete('cascade');
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
        Schema::dropIfExists('order__details');
    }
};
