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
        Schema::create('investor_profit', function (Blueprint $table) {
            $table->id('id_investor_profit');
            $table->unsignedBigInteger('id_investor');
            $table->unsignedBigInteger('id_investment_slot');
            $table->string('profit', 100);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('proof_image', 200);
            $table->foreign('id_investor')->references('id_investor')->on('investor')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_investment_slot')->references('id_investment_slot')->on('investment_slot')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_profit');
    }
};
