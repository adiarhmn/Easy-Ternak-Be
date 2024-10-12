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
        Schema::create('marketplace_details', function (Blueprint $table) {
            $table->id('id_marketplace_details');
            $table->unsignedBigInteger('id_marketplace_animal');
            $table->unsignedBigInteger('id_payment_method')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->string('proof_image')->nullable();
            $table->string('status')->default('pending');
            $table->datetime('expired_at')->nullable();
            $table->foreign('id_marketplace_animal')->references('id_marketplace_animal')->on('marketplace_animal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_payment_method')->references('id_payment_method')->on('payment_method')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplace_details');
    }
};
