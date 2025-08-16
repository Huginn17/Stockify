@extends('manajer.layout.main')

@section('contentmanajer')
    <div class="p-4 sm:ml-64">

        <div class="">
            <h1 class="text-xl font-bold mb-4">Stok Opname 📦 :</h1>
            <div class="relative flex overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-white uppercase bg-blue-400 dark:bg-blue-700 dark:text-gray-400">
                        <tr class="bg-gray-800 text-white">
                            <th class="px-6 py-3 ">NAMA PRODUK</th>
                            <th class="px-6 py-3 ">JUMLAH SAAT INI</th>
                            <th class="px-6 py-3 ">PERUBAHAN TERAKHIR</th>
                            <th class="px-6 py-3 ">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $p)
                            <tr
                                class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-3 ">{{ $p->name }}</td>
                                <td class="px-6 py-3 ">{{ $p->jumlah_saat_ini }}</td>
                                <td class="px-6 py-3">
                                    @if ($p->perubahan_terakhir)
                                        @if ($p->perubahan_terakhir['type'] === 'masuk')
                                            <span class="text-green-600 font-bold">
                                                {{ $p->perubahan_terakhir['quantity'] }} Unit Masuk
                                            </span>
                                        @else
                                            <span class="text-red-600 font-bold">
                                                {{ $p->perubahan_terakhir['quantity'] }} Unit Keluar
                                            </span>
                                        @endif
                                        pada {{ $p->perubahan_terakhir['created_at'] }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-6 py-3 ">
                                    <a href="{{ route('manajer.opname.detail', $p->id) }}" style="text-decoration: none"
                                        class="bg-gray-800 font-semibold text-white px-3 py-1 rounded-full hover:bg-orange-500 transition duration-300">
                                        Detail </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('manajer.stock') }}" style="font-size: medium; text-decoration: none;"
            class="bg-gray-800 hover:bg-gray-600 btn rounded-full px-4 mt-4 font-bold text-white">
            Kembali
        </a>
    </div>
@endsection
