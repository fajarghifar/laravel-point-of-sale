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
        Schema::create('pay_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->date('date')->nullable();
            $table->integer('paid_amount');
            $table->integer('advance_salary')->nullable();
            $table->integer('due_salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_salaries');
    }
};
