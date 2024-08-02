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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->decimal('denda', 10, 2)->nullable()->after('harga_total');
            $table->boolean('rusak')->default(false)->after('denda');
            $table->date('tanggal_pengembalian')->nullable()->after('rusak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('denda');
            $table->dropColumn('rusak');
            $table->dropColumn('tanggal_pengembalian');
        });
    }
};
