<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $table = 'stock_transactions';
    protected $guarded = [];

    protected $fillable = [
        'product_id',
        'user_id',
        'supplier_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
        'is_opname',
        'opname_reference',
    ];

    protected $casts = [
        'is_opname' => 'boolean',
        'date' => 'datetime',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
