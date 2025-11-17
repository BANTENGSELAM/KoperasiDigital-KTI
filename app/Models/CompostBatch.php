<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompostBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_batch',
        // 'pickup_id',
        'berat_masuk_kg',
        'berat_keluar_kg',
        'tgl_mulai',
        'tgl_selesai',
        'status',
    ];

    public function pickup()
    {
        return $this->belongsTo(Pickup::class, 'pickup_id');
    }
}
