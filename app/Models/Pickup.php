<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'pickups';

    protected $fillable = [
        'user_id',
        'petugas_id',
        'tanggal',
        'berat_kg',
        'jenis',
        'lokasi',
        'status',
        'catatan',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function batch()
    {
        return $this->hasOne(CompostBatch::class, 'pickup_id');
    }
}
