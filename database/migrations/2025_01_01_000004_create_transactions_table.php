<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();          // e.g. TXN-20250610-0001
            $table->foreignId('attendant_id')
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->enum('payment_method', ['cash', 'mpesa']);
            $table->string('mpesa_phone')->nullable();
            $table->string('mpesa_ref')->nullable();        // Safaricom transaction code
            $table->string('checkout_request_id')->nullable(); // Daraja STK request ID
            $table->decimal('total', 10, 2);
            $table->decimal('profit', 10, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
