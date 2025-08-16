@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold mb-4 text-white">Laporan Barang Keluar 📝</h2>
            </div>

            <form method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex items-end gap-4">
                    <div class="flex flex-col">
                        <label for="tanggal_mulai" class="text-white font-semibold">Tanggal Mulai :</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                            class=" p-2 border rounded hover:bg-gray-50 transition duration-300" />
                    </div>
                    <div class="flex flex-col">
                        <label for="tanggal_selesai" class="text-white font-semibold">Tanggal Selesai :</label>
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                            class=" p-2 border rounded hover:bg-gray-50 transition duration-300" />
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-orange-600 text-white px-4 py-2 rounded-full font-bold hover:bg-orange-400 transition">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="relative flex overflow-x-auto shadow-sm sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-400 dark:bg-blue-700 dark:text-gray-400">
                    <tr class="bg-gray-800 text-white">
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Jumlah Keluar</th>
                        <th class="px-6 py-3">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $trx)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class=" px-6 py-3">{{ $trx->date->format('d-m-Y') }}</td>
                            <td class=" px-6 py-3">{{ $trx->produk->name ?? '-' }}</td>
                            <td class=" px-6 py-3">{{ $trx->produk->kategori->name ?? '-' }}</td>
                            <td class=" px-6 py-3">{{ $trx->quantity }}</td>
                            <td class=" px-6 py-3">{{ $trx->user->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $transaksi->links() }}
        <form action="{{ route('manajer.laporan.masuk') }}" method="GET"><br>
            <button type="submit" style="-radius: 20vh"
                class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
                Kembali
            </button>
        </form>
    </div>
@endsection
