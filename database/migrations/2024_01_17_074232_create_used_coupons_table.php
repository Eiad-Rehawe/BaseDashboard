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
        Schema::create('used_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate()->uniqid()->nullable();
            $table->foreignId('coupon_id')->on('coupons')->cascadeOnDelete()->cascadeOnUpdate()->uniqid();
            $table->foreignId('order_id')->on('orders')->cascadeOnDelete()->cascadeOnUpdate()->uniqid();
            $table->foreignId('custemor_id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate()->uniqid()->nullable();

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
        Schema::dropIfExists('used_cupons');
    }
};
