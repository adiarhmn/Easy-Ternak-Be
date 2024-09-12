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
        Schema::create('animal', function (Blueprint $table) {
            $table->id('id_animal');
            $table->unsignedBigInteger('id_mitra');
            $table->string('animal_code');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_sub_animal_type');
            $table->integer('price');
            $table->date('selling_date');
            $table->date('purchase_date');
            $table->string('status');
            $table->string('investment_type');
            $table->integer('total_slots');
            $table->foreign('id_sub_animal_type')->references('id_sub_animal_type')->on('sub_animal_type')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal');
    }
};