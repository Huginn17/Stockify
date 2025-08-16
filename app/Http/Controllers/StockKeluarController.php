<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockKeluarController extends Controller
{
    public function create()
    {
        $products = Produk::all();
        return view('manajer.stock.keluar.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        
        $products = Produk::findOrFail($request->product_id);

        if ($request->quantity > $products->current_stock) {
            return back()->with('error', 'Stok Tidak Mencukupi  ❌');
        }

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'date' => $request->date ?? now(),
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        $product = Produk::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $type = 'keluar';

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

        return back()->with('success', 'Stock Berhasil Dikeluarkan ✔️');
    }
}
