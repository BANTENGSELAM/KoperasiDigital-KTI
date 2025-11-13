<?php

namespace App\Models;  // <-- harus persis seperti ini!

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'pembeli',
        'jumlah_kg',
        'harga_per_kg',
        'total',
        'tanggal',
    ];

    public function batch()
    {
        return $this->belongsTo(CompostBatch::class, 'batch_id');
    }
}
