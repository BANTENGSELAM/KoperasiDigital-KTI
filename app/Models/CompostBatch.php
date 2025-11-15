<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompostBatch extends Model
{
    protected $fillable = [
        'pickup_id',
        'kode_batch',
        'berat_kompos',
        'tanggal_produksi',
    ];

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }
}
