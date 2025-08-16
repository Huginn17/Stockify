<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $guarded = [];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
