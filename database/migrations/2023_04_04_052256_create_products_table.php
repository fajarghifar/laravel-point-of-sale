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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            // Stock & Pricing
            $table->integer('stock')->default(0);
            $table->integer('buying_price')->nullable();
            $table->integer('selling_price')->nullable();
            // Details
            $table->string('image')->nullable();
            $table->date('buying_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
