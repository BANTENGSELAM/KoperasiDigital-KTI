<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'lokasi',
        'berat_sampah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
