<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    
    //KEDUA
    public function index2()
{
    $produk = Produk::with(['stockTransactions' => function ($p) {
        $p->whereIn('status', ['Diterima','Dikeluarkan'])
          ->orderBy('created_at', 'desc');
    }])->get()->map(function ($produk) {

        // ambil transaksi terakhir
        $lasttr = $produk->stockTransactions->first();

        // tambahkan atribut jumlah_saat_ini dari accessor
        $produk->setAttribute('jumlah_saat_ini', $produk->current_stock);

        // tambahkan atribut perubahan_terakhir
        $produk->setAttribute('perubahan_terakhir', $lasttr ? [
            'quantity' => $lasttr->quantity,
            'type'     => $lasttr->type,
            'date'     => \Carbon\Carbon::parse($lasttr->date)->format('d M Y H:i'),
            'status'   => $lasttr->status,
            'created_at' => $lasttr->created_at->format('d M Y H:i')
           
        ] : null);

        

        return $produk;
    });

    return view('manajer.stock.opname', compact('produk'));
}


    public function detail($id) {
        $produk = Produk::findorFail($id);

        $transaksi = StockTransaction::where('product_id', $id)
        ->orderBy('date', 'desc')
        ->get();

        return view('manajer.stock.show', compact('produk', 'transaksi'));
    }
}
