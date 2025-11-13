<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compost_batches', function (Blueprint $table) {
            $table->id(); // penting: unsignedBigInteger
            $table->string('kode_batch')->unique();
            $table->decimal('berat_masuk_kg', 10, 2)->default(0);
            $table->decimal('berat_keluar_kg', 10, 2)->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->enum('status', ['proses', 'selesai', 'dibatalkan'])->default('proses');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compost_batches');
    }
};
