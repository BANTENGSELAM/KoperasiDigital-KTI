<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $table = 'ledgers';

    protected $fillable = [
        'kategori',
        'type', // income | expense
        'amount',
        'tanggal',
        'ref_id',
        'ref_type',
        'catatan'
    ];
}
