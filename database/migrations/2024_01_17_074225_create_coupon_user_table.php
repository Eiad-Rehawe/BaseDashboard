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
        
        Schema::create('coupon_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('coupon_id')->on('coupons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('custemor_id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
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
        Schema::dropIfExists('cupon_users');
    }
};
