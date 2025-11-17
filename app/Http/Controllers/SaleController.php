<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Sales;
use App\Models\CompostBatch;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sales::with('batch')->get();

        return view('sales.index', compact('sales'));
    }

   public function create()
    {
        // hanya batch yang punya pupuk untuk dijual (berat_keluar_kg > 0 atau status selesai)
        $batches = CompostBatch::where('berat_keluar_kg','>',0)->orWhere('status','selesai')->get();
        return view('admin.sales.create', compact('batches'));
    }
    
    public function store(Request $r)
    {
        $r->validate([
            'batch_id'=>'nullable|exists:compost_batches,id',
            'pembeli'=>'required|string',
            'jumlah_kg'=>'required|numeric|min:0.01',
            'harga_per_kg'=>'required|numeric|min:0',
            'tanggal'=>'required|date',
        ]);
        $total = $r->jumlah_kg * $r->harga_per_kg;
        $sale = Sales::create([
            'batch_id'=>$r->batch_id,
            'pembeli'=>$r->pembeli,
            'jumlah_kg'=>$r->jumlah_kg,
            'harga_per_kg'=>$r->harga_per_kg,
            'total'=>$total,
            'tanggal'=>$r->tanggal,
        ]);
        // ledger: catat income
        \App\Models\Ledger::create([
            'kategori'=>'Penjualan Pupuk',
            'type'=>'income',
            'amount'=>$total,
            'tanggal'=>$r->tanggal,
            'ref_id'=>$sale->id,
            'ref_type'=>Sales::class,
        ]);
        return redirect()->route('admin.sales.index')->with('success','Penjualan dicatat.');
    }
}
