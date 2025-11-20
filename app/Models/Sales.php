<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'batch_id',
        'pembeli',
        'jumlah_kg',
        'harga_per_kg',
        'total',
        'tanggal'
    ];

    public function batch()
    {
        return $this->belongsTo(CompostBatch::class);
    }
}
