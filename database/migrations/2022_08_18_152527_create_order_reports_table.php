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
        Schema::create('order_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('online_payment')->default(0);
            $table->integer('online_total')->default(0);
            $table->integer('cod_payment')->default(0);
            $table->integer('cod_total')->default(0);
            $table->integer('order_total')->default(0);
            $table->integer('cart_total')->default(0);
            $table->integer('shipping_total')->default(0);
            $table->integer('grand_total')->default(0);
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
        Schema::dropIfExists('order_reports');
    }
};
