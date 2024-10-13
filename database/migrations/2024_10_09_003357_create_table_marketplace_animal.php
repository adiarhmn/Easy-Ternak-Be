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
        Schema::create('marketplace_animal', function (Blueprint $table) {
            $table->id('id_marketplace_animal');
            $table->unsignedBigInteger('id_animal');
            $table->unsignedBigInteger('id_mitra');
            $table->integer('price');
            $table->string('status')->default('ready');
            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mitra')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplace_animal');
    }
};
