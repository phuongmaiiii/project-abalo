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
        Schema::create('ab_shoppingcart', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('ab_creator_id')
                ->nullable(false);
            $table->foreign('ab_creator_id')
                ->references('id')
                ->on('ab_user')
                ->onDelete('cascade');
            $table->timestamp('ab_createdate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_shoppingcart');
    }
};
