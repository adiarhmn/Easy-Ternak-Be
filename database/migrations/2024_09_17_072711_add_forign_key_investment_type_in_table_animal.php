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
        Schema::table('animal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_investment_type')->after('id_animal');
            $table->foreign('id_investment_type')->references('id_investment_type')->on('investment_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animal', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_investment_type');
            // $table->dropColumn('id_investment_type');
        });
    }
};
