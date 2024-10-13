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
            $table->enum('distribution_status', ['pending', 'success', 'failed'])->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investment_slot', function (Blueprint $table) {
            $table->dropColumn('distribution_status');
        });
    }
};
