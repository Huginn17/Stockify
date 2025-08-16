<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Produk::with('kategori', 'supplier')->get()->map(function ($produk) {
            return [
                'Nama Produk'     => $produk->name,
                'Kategori'        => $produk->kategori->name ?? '',
                'Supplier'        => $produk->supplier->name ?? '',
                'SKU'             => $produk->sku,
                'Deskripsi'       => $produk->description,
                'Harga Beli'      => $produk->purchase_price,
                'Harga Jual'      => $produk->selling_price,
                'Gambar'          => $produk->image,
                'Minimum Stok'    => $produk->minimum_stock,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori',
            'Supplier',
            'SKU',
            'Deskripsi',
            'Harga Beli',
            'Harga Jual',
            'Gambar',
            'Minimum Stok',
        ];
    }
}

