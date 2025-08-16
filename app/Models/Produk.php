<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $guarded = [];


    public function kategori():BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function attribut()
    {
        return $this->hasMany(Attribut::class, 'product_id');
    }


    
public function stockTransactions()
{
    return $this->hasMany(StockTransaction::class, 'product_id');
}

public function getCurrentStockAttribute()
{
    $masuk = $this->stockTransactions()->where('type', 'masuk')->where('status', 'Diterima')->sum('quantity');
    $keluar = $this->stockTransactions()->where('type', 'keluar')->where('status', 'Dikeluarkan')->sum('quantity');
    return $masuk - $keluar;

    $transaksi = $this->stockTransactions()
        ->whereIn('status', ['Diterima', 'Dikeluarkan'])
        ->get();

     return $transaksi->sum(function ($t) {
         return $t->type == 'masuk' ? $t->quantity : -$t->quantity;
     });
}

}
