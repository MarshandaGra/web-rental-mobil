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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesan_id');
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('bayar_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_kembali');
            $table->integer('harga_total');
            $table->foreign('pemesan_id')->references('id')->on('pemesans');
            $table->foreign('mobil_id')->references('id')->on('mobils');
            $table->foreign('bayar_id')->references('id')->on('bayars');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};