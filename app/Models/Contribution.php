<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'user_id',
        'berat_sampah',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
