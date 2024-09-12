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
        Schema::create('sub_animal_type', function (Blueprint $table) {
            $table->id('id_sub_animal_type');
            $table->string('name', 100);
            $table->unsignedBigInteger('id_animal_type');
            $table->timestamps();
            $table->foreign('id_animal_type')->references('id_animal_type')->on('animal_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_animal_type');
    }
};
