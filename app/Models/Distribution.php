<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah_diterima',
        'persentase',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
