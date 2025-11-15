<?php

namespace App\Http\Controllers\Admin;

use id;
use App\Models\Pickup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    public function memberIndex()
{
    $pickups = Pickup::where('user_id', auth()->id())->get();
    return view('member.pickups.index', compact('pickups'));
}
}
