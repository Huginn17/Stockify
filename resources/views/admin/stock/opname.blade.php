@extends('admin.layout.main')
@section('contentadmin')
    <div class="sm:ml-60">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Stok Opname ⎙</h3>
            <form action="{{ route('admin.stock') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4  rounded-full shadow-lg -white transition duration-300">
                    Kembali
                </button>
            </form>
        </div>
        <div class="relative flex overflow-x-auto shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-400 dark:bg-blue-700 dark:text-gray-400">
                    <tr class="bg-gray-800 text-white">
                        <th class="px-6 py-3">NAMA PRODUK</th>
                        <th class="px-6 py-3">JUMLAH SAAT INI</th>
                        <th class="px-6 py-3">PERUBAHAN TERAKHIR</th>
                        <th class="px-6 py-3">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-3">{{ $p->name }}</td>
                            <td class="px-6 py-3">{{ $p->jumlah_saat_ini }}</td>
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

                            <td class="px-6 py-3">
                                <a href="{{ route('admin.opname.detail', $p->id) }}" Method="GET" class="inline-block">

                                    <button type="submit" style="border-radius: 20vh; text-decoration: none"
                                        class="bg-orange-500 hover:bg-orange-400 text-white font-semibold py-1 px-3 flex items-center shadow gap-1">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
