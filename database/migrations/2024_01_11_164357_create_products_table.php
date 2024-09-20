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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->foreignId('category_id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('weight_measurement_id')->on('weight_measurements')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->string('barcode_id')->nullable()->unique();
            $table->integer('status')->default(1);
            $table->integer('quantity')->default(0);
            $table->text('descrption_ar');
            $table->text('descrption_en');
            $table->float('wight')->nullable();
            $table->float('purchasing_price')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('new_selling_price')->nullable();
             $table->integer('review_count')->default(0);
            $table->float('review_avg')->nullable();
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
        Schema::dropIfExists('products');
    }
};
