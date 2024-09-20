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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->on('admins')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('customer_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->text('complaint_text');
            $table->text('cause_problem')->nullable();
            $table->date('complaint_date');
            $table->integer('status')->default(0);
            $table->string('employee_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
