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
        Schema::table('investment_slot', function (Blueprint $table) {
            $table->unsignedBigInteger('id_payment_method')->nullable();
            $table->foreign('id_payment_method')->references('id_payment_method')->on('payment_method')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investment_slot', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_payment_method');
        });
    }
};
