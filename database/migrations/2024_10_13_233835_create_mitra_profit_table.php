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
        Schema::create('mitra_profit', function (Blueprint $table) {
            $table->id('id_mitra_profit');
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_animal');
            $table->string('profit', 100);
            $table->string('proof_image', 200);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_profit');
    }
};
