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
        Schema::create('mitra', function (Blueprint $table) {
            $table->id('id_mitra');
            $table->unsignedBigInteger('id_user');
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('telephone', 15);
            $table->string('nik', 16);
            $table->string('ktp_image', 255);
            $table->float('rating', 2, 1)->default(0);
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};
