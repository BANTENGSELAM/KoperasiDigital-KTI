<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Sales;

class PetugasSalesController extends Controller
{
    public function index()
    {
        $sales = Sales::with('batch')->latest()->get();
        return view('petugas.sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sales::with('batch')->findOrFail($id);
        return view('petugas.sales.show', compact('sale'));
    }
}
