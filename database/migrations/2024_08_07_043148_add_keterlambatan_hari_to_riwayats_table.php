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
        Schema::table('riwayats', function (Blueprint $table) {
            $table->integer('keterlambatan_hari')->default(0)->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayats', function (Blueprint $table) {
            $table->dropColumn('keterlambatan_hari');
        });
    }
};