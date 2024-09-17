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
        Schema::create('animal_expenses', function (Blueprint $table) {
            $table->id('id_animal_progress');
            $table->unsignedBigInteger('id_animal');
            $table->string('description', 250);
            $table->integer('price');
            $table->date('date');
            $table->timestamps();

            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_expenses');
    }
};
