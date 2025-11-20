<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompostBatch extends Model
{
    protected $fillable = [
        'kode_batch',
        'pickup_id',
        'berat_masuk_kg',
        'berat_keluar_kg',
        'tanggal_mulai',
        'tanggal_selesai',
        'catatan',
    ];

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }
}
