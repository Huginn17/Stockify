@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <section class="bg-gray dark:bg-gray-900 py-8 px-4">
            <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-2xl font-bold text-white dark:text-white mb-6 text-center">Detail Produk </h3>
                <br>
                <div class="overflow-x-auto sm:rounded-lg shadow">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200 dark:border-gray-700 shadow-md">
                        <tbody>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium w-1/3">Nama Produk :</th>
                                <td class="px-6 py-3">{{ $produk->name }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Kategori :</th>
                                <td class="px-6 py-3">{{ $produk->kategori->name }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Supplier :</th>
                                <td class="px-6 py-3">{{ $produk->supplier->name }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">SKU :</th>
                                <td class="px-6 py-3">{{ $produk->sku }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Deskripsi :</th>
                                <td class="px-6 py-3">{{ $produk->description }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Harga Jual :</th>
                                <td class="px-6 py-3">Rp {{ number_format($produk->purchase_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Harga Beli :</th>
                                <td class="px-6 py-3">Rp {{ number_format($produk->selling_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr
                                class="odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Gambar :</th>
                                <td class="px-6 py-3">
                                    @if ($produk->image)
                                        <img src="{{ asset('storage/' . $produk->image) }}" alt="Gambar Produk"
                                            class="w-28 h-28 object-cover rounded shadow">
                                    @else
                                        <span class="italic text-gray-400">Tidak ada gambar :</span>
                                    @endif
                                </td>
                            </tr>
                            <tr
                                class="bg-gray-100 dark:bg-gray-800 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th class="px-6 py-3 font-medium">Minimum Stock</th>
                                <td class="px-6 py-3">{{ $produk->minimum_stock }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 ml-2">
                    <form action="{{ route('manajer.produk') }}" method="GET"><br>
                        <button type="submit" style="-radius: 20vh"
                            class="bg-orange-500 text-white hover:bg-gray-700 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
                            Kembali
                        </button>
                </div>
            </div>
        </section>
    </div>
@endsection
