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
        Schema::create('billing_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order__summery_id');
            $table->string('b_f_name');
            $table->string('b_l_name');
            $table->string('b_email');
            $table->integer('b_divission');
            $table->integer('b_zilla');
            $table->integer('b_upozilla');
            $table->integer('b_zip_code');
            $table->string('b_address');
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
        Schema::dropIfExists('billing_informations');
    }
};
