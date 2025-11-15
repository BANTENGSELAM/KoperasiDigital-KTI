<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompostBatch extends Model
{
    protected $fillable = [
        'kode_batch',
        'berat_masuk_kg',
        'berat_keluar_kg',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'keterangan',
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'batch_id');
    }
}
