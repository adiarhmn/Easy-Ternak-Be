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
        Schema::table('investor_profit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_animal')->nullable();
            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investor_profit', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_animal');
        });
    }
};
