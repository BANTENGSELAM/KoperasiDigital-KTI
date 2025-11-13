<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'petugas_id',
        'tanggal',
        'berat_kg',
        'jenis',
        'lokasi',
        'status',
        'catatan'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
