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
        Schema::create('investment_slot', function (Blueprint $table) {
            $table->id('id_investment_slot');
            $table->unsignedBigInteger('id_animal');
            $table->unsignedBigInteger('id_investor')->nullable();
            $table->string('slot_code');
            $table->integer('slot_price');
            $table->integer('profit')->default(0);
            $table->string('status')->default('ready');
            $table->datetime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_slot');
    }
};
