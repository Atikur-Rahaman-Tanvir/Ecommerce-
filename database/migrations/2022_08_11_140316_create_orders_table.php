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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order__summery_id');
            $table->text('name')->nullable;
            $table->text('email')->nullable;
            $table->text('phone')->nullable;
            $table->integer('amount')->nullable;
            $table->text('address')->nullable;
            $table->text('status')->nullable;
            $table->text('transaction_id')->nullable;
            $table->text('currency')->nullable;
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
        Schema::dropIfExists('orders');
    }
};
