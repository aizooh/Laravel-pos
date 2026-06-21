<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mpesa_callbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')
                  ->nullable()
                  ->constrained('transactions')
                  ->onDelete('set null');
            $table->string('checkout_request_id')->index();
            $table->string('merchant_request_id')->nullable();
            $table->integer('result_code')->nullable();
            $table->string('result_desc')->nullable();
            $table->string('mpesa_receipt')->nullable();    // Safaricom transaction code e.g. QK12BNJ3X
            $table->string('phone')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->json('raw_payload')->nullable();        // full Daraja JSON stored for debugging
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mpesa_callbacks');
    }
};
