<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalPost extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'konten',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
