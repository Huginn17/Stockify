@extends('admin.layout.main')
@section('contentadmin')
 <h3>Detail Produk</h3>
        <table>
            <tbody>
                <tr>
                    <td>Nama Produk</td>
                    <td width="2px"></td>
                    <td>{{ $produk->name }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td width="2px"></td>
                    <td>{{ $produk->kategori->name }}</td>
                </tr>
                <tr>
                    <td>Supplier</td>
                    <td width="2px"></td>
                    <td>{{ $produk->supplier->name }}</td>
                </tr>
                <tr>
                    <td>Sku</td>
                    <td width="2px"></td>
                    <td>{{ $produk->sku }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td width="2px"></td>
                    <td>{{ $produk->description }}</td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td width="2px"></td>
                    <td>{{ $produk->purchase_price }}</td>
                </tr>
                <tr>
                    <td>Harga Beli</td>
                    <td width="2px"></td>
                    <td>{{ $produk->selling_price }}</td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td width="2px"></td>
                    <td>{{ $produk->image }}</td>
                </tr>
                <tr>
                    <td>Minimum Stock</td>
                    <td width="2px"></td>
                    <td>{{ $produk->minimum_stock }}</td>
                </tr>
            </tbody>
        </table>
@endsection