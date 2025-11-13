<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // penyetor
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tanggal');
            $table->decimal('berat_kg', 8, 2)->default(0);
            $table->string('jenis')->nullable(); // jenis sampah (organik, non, campuran)
            $table->string('lokasi')->nullable();
            $table->enum('status', ['dijadwalkan','diambil','selesai','dibatalkan'])->default('dijadwalkan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickups');
    }
};
