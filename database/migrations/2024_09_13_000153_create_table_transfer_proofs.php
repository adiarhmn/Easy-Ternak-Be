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
        Schema::create('transfer_proofs', function (Blueprint $table) {
            $table->id('id_transfer_proofs');
            $table->unsignedBigInteger('id_investment_slot');
            $table->string('proof_image', 200);
            $table->timestamps();

            $table->foreign('id_investment_slot')->references('id_investment_slot')->on('investment_slot')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_proofs');
    }
};
