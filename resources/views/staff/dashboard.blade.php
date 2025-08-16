@extends('staff.layout.main')
@section('contentstaff')
    @php
        $setting = \App\Models\Setting::pluck('value', 'key');
    @endphp

    <div class="p-4 sm:ml-64">
        <nav class="sm:rounded-lg border-gray-200 dark:bg-gray-900 p-4 shadow-sm bg-gray-800">
            <div class="flex justify-between items-center">
                <div class="ml-2 text-orange-400" style="font-size: 19px; font-weight: bold">Staff</div>
                @if (!empty($setting['apk_logo']))
                    <img src="{{ asset('storage/' . $setting['apk_logo']) }}" alt="Logo" class="h-12 rounded shadow-md">
                @endif
            </div>
            <hr border="1" color="white">
            <div style="font-size: 28px;" class="ml-2">
                <div style="margin-bottom: 8px;">
                    <p class="text-white" style="margin-bottom: 4px;">Hallo, Selamat Datang
                        <strong>{{ Auth::user()->name }}</strong>
                    </p>
                    <p style="font-size: 14px; color: rgb(255, 255, 255); margin-top: 0;">Kelola Stok Barang Kamu &
                        Tingkatkan Bisnismu Di Stockify</p>
                </div>
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"> </span>
                    </a>
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                            <span class="sr-only">Buka menu user</span>

                        </button>

                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                            id="user-dropdown">
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            </ul>
                        </div>
                        <button data-collapse-toggle="navbar-user" type="button"
                            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="navbar-user" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 1h15M1 7h15M1 13h15" />
                            </svg>
                        </button>
                    </div>



                    {{-- MASUK --}}
                    <!-- Modal toggle -->
                    <div style="font-size: 18px">
                        <button data-modal-target="mantap" data-modal-toggle="mantap"
                            style="border-radius: 20vh; text-decoration: none;"
                            class="bg-orange-500 text-white hover:bg-orange-400 font-bold py-2 px-5 rounded-full shadow-lg border-white transition duration-300"
                            type="button">
                            Lihat Barang Masuk +
                            @if ($jumlahMasuk > 0)
                                <span class="ml-2 bg-red-600 px-2 py-1 text-xs rounded-full animate-pulse">
                                    {{ $jumlahMasuk }}
                                </span>
                            @endif
                        </button>
                    </div>

                    <!-- Main modal -->
                    <div id="mantap" data-modal-backdrop="mantap" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
                        <div class="relative p-4 w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Detail Barang Masuk :
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="mantap">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    <div class="overflow-x-auto">
                                        <table
                                            class="w-full text-sm text-left text-gray-700 dark:text-gray-200 border border-gray-300 sm:rounded-lg dark:border-gray-600">
                                            <thead
                                                class="bg-gray-800 dark:bg-gray-600 text-white dark:text-gray-100 sm:rounded-lg text-sm">
                                                <tr>
                                                    <th class="px-4 py-2">Produk</th>
                                                    <th class="px-4 py-2">Jumlah</th>
                                                    <th class="px-4 py-2">Tanggal</th>
                                                    <th class="px-4 py-2">Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($barangmasuk as $m)
                                                    <tr class="bg-white dark:bg-gray-800 border-t dark:border-gray-600">
                                                        <td class="px-4 py-2">{{ $m->produk->name }}</td>
                                                        <td class="px-4 py-2">{{ $m->quantity }}</td>
                                                        <td class="px-4 py-2">{{ $m->date }}</td>
                                                        <td class="px-4 py-2">{{ $m->notes }}</td>
                                                    </tr>
                                                @empty
                                                    <tr class="bg-white dark:bg-gray-800">
                                                        <td colspan="4"
                                                            class="px-4 py-3 text-center italic text-gray-900 dark:text-gray-400">
                                                            Tidak ada barang masuk
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- KELUAR --}}

                    <!-- Modal toggle -->
                    <div style="font-size: 18px">
                        <button data-modal-target="mantul" data-modal-toggle="mantul"
                            style="border-radius: 20vh; text-decoration: none;"
                            class="bg-orange-500 text-white hover:bg-orange-400  font-bold py-2 px-5 rounded-full shadow-lg border-white transition duration-300"
                            type="button">
                            Lihat Barang Keluar -
                            @if ($jumlahKeluar > 0)
                                <span class="ml-2 bg-red-600 px-2 py-1 text-xs rounded-full animate-pulse">
                                    {{ $jumlahKeluar }}
                                </span>
                            @endif
                        </button>
                    </div>

                    <!-- Main modal -->
                    <div id="mantul" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
                        <div class="relative p-4 w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Detail Barang Keluar :
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="mantul">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    <div class="overflow-x-auto">
                                        <table
                                            class="w-full text-sm text-left text-gray-700 dark:text-gray-200 border dark:border-gray-600">
                                            <thead
                                                class="bg-gray-800 dark:bg-gray-600 text-white dark:text-gray-100 text-sm">
                                                <tr>
                                                    <th class="px-4 py-2">Produk</th>
                                                    <th class="px-4 py-2">Jumlah</th>
                                                    <th class="px-4 py-2">Tanggal</th>
                                                    <th class="px-4 py-2">Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($barangkeluar as $k)
                                                    <tr class="bg-white dark:bg-gray-800 border-t dark:border-gray-600">
                                                        <td class="px-4 py-2">{{ $k->produk->name }}</td>
                                                        <td class="px-4 py-2">{{ $k->quantity }}</td>
                                                        <td class="px-4 py-2">{{ $k->date }}</td>
                                                        <td class="px-4 py-2">{{ $k->notes }}</td>
                                                    </tr>
                                                @empty
                                                    <tr class="bg-white dark:bg-gray-800">
                                                        <td colspan="4"
                                                            class="px-4 py-3 text-center italic text-gray-900 dark:text-gray-400">
                                                            Tidak ada barang keluar
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative overflow-hidden mt-5 font-semibold bg-gray-800 text-white rounded-lg shadow-lg p-3 group">
            <div class="overflow-hidden whitespace-nowrap ">
                <div class="inline-block"
                    style="animation: marquee-left 35s linear infinite; white-space: nowrap; font-style: italic">
                    📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                    tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                    waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya| &nbsp;
                    📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                    tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                    waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya| &nbsp;
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


        {{-- Ringkas --}}

        {{-- ringkasan Tugas  --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            {{-- barang masuk  --}}
            <div
                class="bg-gray-800 hover:bg-gray-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-[1.03] transition duration-300">
                <div>
                    <h2 class="text-lg font-bold">Barang Masuk Pending</h2>
                    <p class="text-3xl font-extrabold text-green-600">{{ $jumlahMasuk }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    📦
                </div>
            </div>

            {{-- barang keluar  --}}
            <div
                class="bg-gray-800 hover:bg-gray-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-[1.03] transition duration-300">
                <div>
                    <h2 class="text-lg font-bold">Barang Keluar Pending</h2>
                    <p class="text-3xl font-extrabold text-red-600">{{ $jumlahKeluar }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    🚚
                </div>
            </div>
        </div>





        <h3 class="text-2xl font-semibold font-sans mt-4">Stock Opname 🗳️</h3>

        <form method="POST" action="{{ route('staff.opname.hitung') }}">
            @csrf

            <div class="overflow-x-auto shadow-md rounded-lg mt-4">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-800 text-white">

                        <tr>
                            <th class="px-6 py-3">NO</th>
                            <th class="px-6 py-3">PRODUK</th>
                            <th class="px-6 py-3">STOCK SISTEM</th>
                            <th class="px-6 py-3">STOCK FISIK</th>
                            <th class="px-6 py-3">SELISIH</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($produk as $index3 => $p)
                            <tr
                                class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 font-bold">{{ $index3 + 1 }}</td>
                                <td class="px-6 py-4">
                                    {{ $p->name }}
                                    <input type="hidden" name="produk[{{ $p->id }}][id]"
                                        value="{{ $p->id }}">
                                </td>
                                <td class="px-6 py-4">{{ $p->stock_sistem }}</td>
                                <td class="px-6 py-4">
                                    <input type="number" name="produk[{{ $p->id }}][stock_fisik]"
                                        value="{{ $p->stock_fisik }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300"
                                        min="0">
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="
                                {{ $p->selisih > 0 ? 'text-green-600' : ($p->selisih < 0 ? 'text-red-600' : 'text-gray-800') }} ">
                                        {{ $p->selisih }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center">

                <div class="mt-4 flex gap-6">
                    <button type="submit" style="border-radius: 20vh"
                        class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-full shadow-sm font-bold transition duration-300">

                        Hitung Selisih
                    </button>
                    <a href="{{ route('staff.opname.show') }}"
                        class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full shadow-sm font-bold text-white"
                        style="text-decoration: none;">
                        Lihat Riwayat Opname
                    </a>



                </div>
        </form>

        @if (session('opname_data'))
            <form method="POST" action="{{ route('staff.opname.store') }}" class="mt-4">
                @csrf
                @foreach ($produk as $p)
                    <input type="hidden" name="produk[{{ $p->id }}][id]" value="{{ $p->id }}">
                    <input type="hidden" name="produk[{{ $p->id }}][stock_fisik]"
                        value="{{ $p->stock_fisik }}">
                @endforeach
                <button type="submit" style="border-radius: 20vh"
                    class="bg-gray-800 hover:bg-gray-600 text-white px-4 py-2 rounded-full font-bold shadow-sm ">
                    Simpan Perubahan
                </button>
            </form>
        @endif

    </div>


    </div>
@endsection
