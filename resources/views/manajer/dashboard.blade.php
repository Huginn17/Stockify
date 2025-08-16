@extends('manajer.layout.main')
@section('contentmanajer')
    <link rel="stylesheet" href="glow.css">
    @php
        $setting = \App\Models\Setting::pluck('value', 'key');
    @endphp

    <body style="background-color: ">
        <div class="p-4 sm:ml-64">
            <nav class="text-white p-4 sm:rounded-lg shadow-lg bg-gray-800">
                <div class="flex justify-between items-center">
                    <h2 class="ml-2 text-orange-400" style="font-size: 19px; font-weight: bold">Manager</h2>
                    @if (!empty($setting['apk_logo']))
                        <img src="{{ asset('storage/' . $setting['apk_logo']) }}" alt="Logo"
                            class="h-12 rounded shadow-md">
                    @endif
                </div>
                <hr border="1" color="white" class="mt-3">
                <div style="font-size: 28px;" class="ml-2">
                    <div style="margin-bottom: 8px;">
                        <p class="text-white mt-2" style="margin-bottom: 4px;">Hallo, Selamat Datang
                            <strong>{{ Auth::user()->name }}</strong>
                        </p>
                        <p style="font-size: 14px; color: rgb(255, 255, 255); margin-top: 0;">Kelola Stok Barang Kamu &
                            Tingkatkan Bisnismu Di Stockify</p>
                    </div>
            </nav>


            <div class="relative overflow-hidden mt-5 font-semibold bg-gray-800 text-white rounded-lg shadow-lg p-3 group">
                <div class="overflow-hidden whitespace-nowrap">
                    <div class="inline-block"
                        style="animation: marquee-left 35s linear infinite; white-space: nowrap; font-style: italic">
                        📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                        tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                        waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya | &nbsp;
                        📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                        tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                        waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya | &nbsp;
                    </div>
                </div>
            </div>

            <style>
                @keyframes marquee-left {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }
            </style>

            <br>
            <div class="mt-3">
                @if ($produkHampirHabis->count())
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Produk Dengan Stok Menipis 🗳️ :
                    </h2>
                    <div class="overflow-x-auto sm:rounded-lg shadow-lg">
                        <table class="w-full text-sm text-left text-gray-700 bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="text-white bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3">NAMA PRODUK</th>
                                    <th class="px-6 py-3">STOCK SAAT INI</th>
                                    <th class="px-6 py-3">STOCK MINIMUM</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($produkHampirHabis as $produk)
                                    <tr
                                        class="hover:bg-gray-100 bg-gray-100 dark:bg-gray-800 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <td class="px-6 py-4">{{ $produk->name }}</td>
                                        <td class="px-6 py-4">{{ $produk->current_stock }}</td>
                                        <td class="px-6 py-4">{{ $produk->minimum_stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-800 text-md font-semibold">Tidak ada produk dengan stock menipis.</p>
                @endif
            </div>
    </body>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5 mb-6">
        {{-- masuk hari Ini --}}
        <div
            class="shadow-orange-glow bg-gray-800 p-4 sm:rounded-lg hover:bg-gray-700 hover:scale-[1.03] transition duration-300">
            <h2 class="text-lg font-semibold" style="color: white">Barang Masuk Hari Ini :</h2>
            <p class="text-2xl text-green-600 mt-1 font-bold">{{ $barangmasukhariini }}</p>
        </div>

        {{-- keluar hari Ini --}}
        <div
            class="shadow-orange-glow bg-gray-800 p-4 sm:rounded-lg hover:bg-gray-700 hover:scale-[1.03] transition duration-300">
            <h2 class="text-lg font-semibold" style="color: white">Barang Keluar Hari Ini :</h2>
            <p class="text-2xl text-red-600 mt-1 font-bold">{{ $barangkeluarhariini }}</p>
        </div>
    </div>
    </div>

@endsection
