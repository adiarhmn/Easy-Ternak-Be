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
            $table->integer('purchase_price')->nullable();
            $table->integer('selling_price')->nullable();
            $table->date('selling_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('status')->default('open');
            $table->integer('total_slots')->default(4);
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
