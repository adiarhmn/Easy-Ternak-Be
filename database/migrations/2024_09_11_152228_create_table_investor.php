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
        Schema::create('investor', function (Blueprint $table) {
            $table->id('id_investor');
            $table->unsignedBigInteger('id_user');
            $table->string('name', 100);
            $table->string('address', 200);
            $table->string('telephone', 20);
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor');
    }
};
