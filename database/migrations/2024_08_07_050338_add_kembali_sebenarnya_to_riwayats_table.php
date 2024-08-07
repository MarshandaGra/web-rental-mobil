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
            $table->timestamp('kembali_sebenarnya')->nullable()->after('tanggal_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayats', function (Blueprint $table) {
            $table->dropColumn('kembali_sebenarnya');
        });
    }
};