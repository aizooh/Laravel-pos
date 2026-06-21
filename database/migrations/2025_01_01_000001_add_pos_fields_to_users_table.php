<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Make default Laravel columns optional (we don't use email/password login)
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();

            // POS-specific columns
            $table->enum('role', ['admin', 'attendant'])->default('attendant')->after('name');
            $table->string('pin', 60)->after('role');          // bcrypt-hashed 4-digit PIN
            $table->boolean('is_active')->default(true)->after('pin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'pin', 'is_active']);
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};
