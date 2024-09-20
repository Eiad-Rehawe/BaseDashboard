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
            $table->string('phone')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->nullable(); //1 order,2 checkout ,3 accept, 0 cancel from user, 4 reject from admin
            $table->float('total')->nullable(); //sum all prices
            $table->float('total_after_discount')->nullable();
            $table->foreignId('user_id')->on('users')->nullable();
            $table->foreignId('custemor_id')->on('customers')->nullable();
            $table->foreignId('coupon_id')->on('cupons')->nullable();
            $table->string('coupon_value')->nullable();
            $table->date('order_date');
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
