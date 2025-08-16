<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribut extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
