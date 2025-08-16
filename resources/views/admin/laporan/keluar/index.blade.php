@extends('admin.layout.main')
@section('contentadmin')
    <div class="sm:ml-60">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl text-white font-bold">Laporan Barang Keluar 📝</h3>
            </div>
            <form method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex items-end gap-4">
                    <div class="flex flex-col">
                        <label for="tanggal_mulai" class="text-white font-semibold">Tanggal Mulai :</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                            class="border p-2 bg-gray-0 rounded shadow-sm hover:bg-gray-100 transition duration-300" />
                    </div>

                    <div class="flex flex-col">
                        <label for="tanggal_selesai" class="text-white font-semibold">Tanggal Selesai :</label>
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                            class="border p-2 rounded bg-gray-0 shadow-sm hover:bg-gray-100 transition duration-300" />
                    </div>

                    <div>
                        <button type="submit" style="border-radius: 20vh"
                            class="bg-orange-500 text-white font-bold hover:bg-orange-400  px-4 py-2 transition duration-300">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="relative overflow-x-auto shadow-lg border-orange-500 sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">
                    <tr class="">
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
                            <td class="px-6 py-3">{{ $trx->date->format('d-m-Y') }}</td>
                            <td class="px-6 py-3">{{ $trx->produk->name ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $trx->produk->kategori->name ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $trx->quantity }}</td>
                            <td class="px-6 py-3">{{ $trx->user->name ?? '-' }}</td>
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
        <form action="{{ route('admin.laporan.masuk') }}" method="GET"><br>
            <button type="submit" style="border-radius: 20vh"
                class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg border-white transition duration-300">
                Kembali
            </button>
        </form>
    </div>
@endsection
