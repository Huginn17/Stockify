@extends('manajer.layout.main')

@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <div class="">
            <h1 class="text-2xl font-semibold mb-4">
                Detail Opname :
                <span class="font-bold text-gray-800">{{ $produk->name }}</span>
            </h1>

            <div class="relative flex overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-white uppercase bg-blue-400 dark:bg-blue-700 dark:text-gray-400">
                        <tr class="bg-gray-800 text-white">
                            <th class="px-6 py-3 ">TANGGAL & JAM</th>
                            <th class="px-6 py-3 ">TIPE</th>
                            <th class="px-6 py-3 ">JUMLAH</th>
                            <th class="px-6 py-3 ">STATUS</th>
                            <th class="px-6 py-3 ">CATATAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $t)
                            <tr
                                class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-3 ">{{ $t->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-3  capitalize">{{ $t->type }}</td>
                                <td class="px-6 py-3 ">{{ $t->quantity }}</td>
                                <td class="px-6 py-3 ">{{ $t->status }}</td>
                                <td class="px-6 py-3 ">{{ $t->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    Tidak ada riwayat opname
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><br>
        <a href="{{ route('manajer.opname') }}" style="font-size: medium; text-decoration: none;"
            class="bg-orange-500 hover:bg-orange-700 btn  rounded-full px-4 py-2 font-bold text-white">
            Kembali
        </a>
    </div>
@endsection
