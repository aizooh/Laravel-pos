<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);  // e.g., 19.99
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->unique()->nullable(); // optional: barcode/SKU
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accessories');
    }
};