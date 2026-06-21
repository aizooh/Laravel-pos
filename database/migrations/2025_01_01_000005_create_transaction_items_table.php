<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')
                  ->constrained('transactions')
                  ->onDelete('cascade');
            $table->enum('item_type', ['product', 'service']);
            $table->unsignedBigInteger('item_id');          // product.id or service.id
            $table->string('item_name');                    // snapshot of name at time of sale
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);           // selling price at time of sale
            $table->decimal('buying_price', 10, 2)->default(0); // 0 for services
            $table->decimal('subtotal', 10, 2);             // unit_price × quantity
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
