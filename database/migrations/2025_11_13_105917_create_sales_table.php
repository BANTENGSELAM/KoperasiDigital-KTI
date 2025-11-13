<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                  ->nullable()
                  ->constrained('compost_batches')
                  ->nullOnDelete();

            $table->string('pembeli');
            $table->decimal('jumlah_kg', 10, 2);
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('total', 15, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
