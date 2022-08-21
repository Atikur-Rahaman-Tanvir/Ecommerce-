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
        Schema::create('shipping__addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order__summery_id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email');
            $table->integer('divission');
            $table->integer('zilla');
            $table->integer('upozilla');
            $table->integer('zip_code');
            $table->string('address');
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
        Schema::dropIfExists('shipping__addresses');
    }
};
