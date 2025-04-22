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
        Schema::create('ab_user', function (Blueprint $table) {
            $table->id() /// automatisch: unsignedBigInteger + auto-increment + primary key
                    ->comment('Primärschlüssel');
            $table->string('ab_name', 80)
                    ->nullable(false)
                    ->comment('Name')
                    ->unique();
            $table->string('ab_password', 200)
                    ->nullable(false)
                    ->comment('Passwort');
            $table->string('ab_email', 200)
                    ->nullable(false)
                    ->comment('E-Mail-Adresse')
                    ->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_users');
    }
};
