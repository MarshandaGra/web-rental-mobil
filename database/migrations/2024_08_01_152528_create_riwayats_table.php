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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesan_id');
            $table->unsignedBigInteger('mobil_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_kembali');
            $table->decimal('harga_total', 10, 2);
            $table->decimal('denda', 10, 2)->nullable(); // Denda dapat kosong jika tidak ada
            $table->timestamps();

            $table->foreign('pemesan_id')->references('id')->on('pemesans');
            $table->foreign('mobil_id')->references('id')->on('mobils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
