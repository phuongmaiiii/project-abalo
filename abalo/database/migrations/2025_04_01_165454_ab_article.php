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
        Schema::create('ab_article', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name', 80)
                ->nullable(false);
            $table->integer('ab_price')
                ->nullable(false)
                ->comment('Preis in Cent');
            $table->string('ab_description', 100)
                ->nullable(false)
                ->comment('Beschreibung, die die Güte oder die Beschaffenheit näher
                            darstellt. Wird durch den „Ersteller“ (ab_user) gepflegt ');

            $table->unsignedBigInteger('ab_creator_id')
                ->nullable(false)
                ->comment('Referenz auf den/die Nutzer:in, der den Artikel erstellt hat und
                            verkaufen möchte');
            $table->timestamp('ab_createdate')
                ->nullable(false);
            $table->foreign('ab_creator_id')
                ->references('id')
                ->on('ab_user')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_article');
    }
};
