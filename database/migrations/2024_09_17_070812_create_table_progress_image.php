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
        Schema::create('progress_image', function (Blueprint $table) {
            $table->id('id_progress_image');
            $table->unsignedBigInteger('id_animal_progress');
            $table->string('image', 200);
            $table->timestamps();

            $table->foreign('id_animal_progress')->references('id_animal_progress')->on('animal_progress')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_image');
    }
};
