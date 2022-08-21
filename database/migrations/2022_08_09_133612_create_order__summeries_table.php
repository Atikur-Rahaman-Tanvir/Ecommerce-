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
        Schema::create('order__summeries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_id');
            $table->integer('cart_total');
            $table->string('coupon_id')->nullable();
            $table->integer('sipping_price');
            $table->date('delivery_date')->nullable();
            $table->integer('order_total');
            $table->integer('p_m_input');
            $table->string('order_status')->default('Pending');
            $table->string('payment_status')->default('Cash On Delivery');
            $table->string('transaction_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('order__summeries');
    }
};
