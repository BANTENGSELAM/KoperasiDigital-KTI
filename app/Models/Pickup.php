<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = [
        'user_id',
        'petugas_id',
        'tanggal',
        'berat_kg',
        'jenis',
        'lokasi',
        'status',
        'catatan',
        'bukti_foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
