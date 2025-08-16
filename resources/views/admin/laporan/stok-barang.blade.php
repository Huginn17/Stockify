@extends('admin.layout.main')
@section('contentadmin')
    <div class="sm:ml-60">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4 flex justify-between items-center">
            <h3 class="text-2xl text-white font-bold ">Laporan Stok Barang Per Bulan & Kategori 📅</h3>
            <form action="{{ route('admin.laporan.masuk') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300">
                    Kembali
                </button>
        </div>


        @foreach ($bulanlist as $b)
            @php
                $periode = Carbon\Carbon::create($b->tahun, $b->bulan, 1);
                $transaksibulan = $transaksiterima->filter(function ($t) use ($b) {
                    return $t->date->format('Y-m') === "{$b->tahun}-" . str_pad($b->bulan, 2, '0', STR_PAD_LEFT);
                });
            @endphp

            <div class="mt-20">
                <h4 class="text-2xl font-semibold text-blue-500 mb-4">
                    Bulan {{ $periode->translatedFormat('F Y') }}
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($kategorilist as $k)
                        @php
                            $produkdalamkategori = $k->produk;
                        @endphp

                        <div class="bg-white sm:rounded-lg shadow-lg p-4 border">
                            <div class="mb-3 border-b pb-2">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $k->name }}</h4>
                            </div>

                            <div class="relative flex overflow-x-auto shadow-sm sm:rounded-lg border">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-2 py-1 text-left">Produk</th>
                                            <th class="px-2 py-1 text-left">Masuk</th>
                                            <th class="px-2 py-1 text-left">Keluar</th>
                                            <th class="px-2 py-1 text-left">Stok Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produkdalamkategori as $pd)
                                            @php
                                                $masuk = $transaksibulan
                                                    ->where('product_id', $pd->id)
                                                    ->where('type', 'masuk')
                                                    ->sum('quantity');
                                                $keluar = $transaksibulan
                                                    ->where('product_id', $pd->id)
                                                    ->where('type', 'keluar')
                                                    ->sum('quantity');
                                            @endphp
                                            <tr
                                                class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                                <td class="px-3 py-2 text-gray-800">{{ $pd->name }}</td>
                                                <td class="px-3 py-2 text-center">{{ $masuk }}</td>
                                                <td class="px-3 py-2 text-center">{{ $keluar }}</td>
                                                <td class="px-3 py-2 text-center">{{ $pd->current_stock }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
