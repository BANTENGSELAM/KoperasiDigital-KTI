<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compost_batches', function (Blueprint $table) {
            $table->id();
            $table->string('kode_batch')->unique();
            $table->foreignId('pickup_id')->nullable()->constrained('pickups')->nullOnDelete();
            $table->decimal('berat_masuk_kg', 10, 2)->default(0);
            $table->decimal('berat_keluar_kg', 10, 2)->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compost_batches');
    }
};
