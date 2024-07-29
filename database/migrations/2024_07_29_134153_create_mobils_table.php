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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_m');
            $table->unsignedBigInteger('merk_id');
            $table->string('kursi');
            $table->string('nomor_polisi');
            $table->integer('tahun');
            $table->integer('harga_per_hari');
            $table->string('gambar');
            $table->foreign('merk_id')->references('id')->on('merks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};