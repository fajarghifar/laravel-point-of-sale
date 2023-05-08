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
            $table->string('product_name');
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->string('product_code')->nullable();
            $table->string('product_garage')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('product_store')->nullable();
            $table->date('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->integer('buying_price')->nullable();
            $table->integer('selling_price')->nullable();
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
