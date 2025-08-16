<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Categories;
use App\Models\Suppliers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class ProdukImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            $kategori = Categories::firstOrCreate(['name' => $row[1]]);
            $supplier = Suppliers::firstOrCreate(['name' => $row[2]]);

            Produk::create([
                'name'           => $row[0],
                'category_id'    => $kategori->id,
                'supplier_id'    => $supplier->id,
                'sku'            => $row[3],
                'description'    => $row[4],
                'purchase_price' => $row[5],
                'selling_price'  => $row[6],
                'image'          => $row[7],
                'minimum_stock'  => $row[8],
            ]);
        }
    }
}
