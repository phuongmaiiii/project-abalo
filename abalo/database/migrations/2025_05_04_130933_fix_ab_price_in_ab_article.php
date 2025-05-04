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
        DB::table('ab_article')
            ->whereBETWEEN('id', [1, 30])
            ->update(['ab_price' => DB::raw('ab_price * 100')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('ab_article')
            ->whereBETWEEN('id', [1, 30])
            ->update(['ab_price' => DB::raw('ab_price / 100')]);
    }
};
