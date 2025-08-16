<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockTransaction;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class StockMasukController extends Controller
{
    public function create()
    {
        $products = Produk::all();
        $suppliers = Suppliers::all();
        return view('manajer.stock.masuk.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

    
        StockTransaction::create([
           'product_id' => $request->product_id,
           'user_id' => auth()->user()->id,
           'supplier_id' => $request->supplier_id,
           'type' => 'masuk',
           'quantity' => $request->quantity,
           'date' => $request->date ?? now(),
           'status' => 'pending',
           'notes' => $request->notes
        ]);

     
        $product = Produk::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $type = 'masuk';

        activity_log(
            "Buat Transaksi",
            "Memabuat Transaksi {$type} untuk produk {$product->name} sebanyak {$quantity}",
            "Transaksi",
            [
                'product_id' => $product->id,
                'type' => $type,
                'quantity' => $quantity
            ]
            );
        
        return redirect()->back()->with('success', 'Stock Berhasil Ditambahkan ✔️');

    }
}
