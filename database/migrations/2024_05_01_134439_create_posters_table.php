<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products')->nullable()->cascadeOnDelete()->cascadeOnUpdate()->onDelete('set null');
            $table->foreignId('category_id')->on('categories')->nullable()->cascadeOnDelete()->cascadeOnUpdate()->onDelete('set null');
            $table->integer('status')->default(1);
            $table->integer('Percentage_discount')->nullable(); //for category
            $table->float('price_discount')->nullable(); //for product
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posters');
    }
};
