<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori', 'type', 'amount', 'tanggal', 'ref_id', 'ref_type', 'catatan'
    ];
}
