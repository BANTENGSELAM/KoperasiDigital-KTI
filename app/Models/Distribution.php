<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $table = 'distributions';

    protected $fillable = [
        'user_id',
        'kontribusi',
        'jumlah_diterima'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
