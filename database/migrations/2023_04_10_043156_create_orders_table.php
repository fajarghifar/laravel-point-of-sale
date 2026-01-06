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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('invoice_no')->unique(); // Unique Invoice
            $table->dateTime('order_date')->index(); // Index for reporting
            $table->string('order_status')->default('pending')->index(); // Status with default
            $table->integer('total_products');
            $table->decimal('sub_total', 15, 2);
            $table->decimal('vat', 15, 2)->default(0);
            $table->decimal('total', 15, 2); // Grand Total
            $table->string('payment_type')->nullable(); // Cash, Card, etc.
            $table->decimal('pay_amount', 15, 2)->default(0); // Paid amount
            $table->decimal('due_amount', 15, 2)->default(0); // Change or Due
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
