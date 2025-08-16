@extends('admin.layout.main')
@section('contentadmin')
    <div class="sm:ml-60">
        <!-- Header & Filter -->
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-white font-semibold">Laporan Barang Masuk 📝</h3>
            </div>

            <form method="GET" class="flex flex-wrap gap-4 items-center">
             <div class="flex items-end gap-4">
                <div class="flex flex-col">
                 <label for="tanggal_mulai" class="text-white font-semibold">Tanggal Mulai :</label>
                 <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                    class="border border-gray-300 hover:bg-gray-50 px-3 py-2 rounded-sm focus:outline-none focus:ring focus:border-blue-300" />
                </div>
                <div class="flex flex-col">
                 <label for="tanggal_selesai" class="text-white font-semibold">Tanggal Selesai :</label>
                 <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                    class="border border-gray-300 hover:bg-gray-50 px-3 py-2 rounded-sm focus:outline-none focus:ring focus:border-blue-300" />
                </div>
                <div>
                    <button type="submit" style="border-radius: 20vh"
                    class="text-white bg-orange-500 hover:bg-orange-400 focus:ring-4 rounded-full focus:ring-blue-300 font-bold text-sm px-4 py-2.5 dark:bg-gray-500 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900 transition duration-300">
                    Filter 
                </button>
                </div>
              </div>
            </form>
        </div>

        <!-- Tabel -->

        <div class="relative overflow-x-auto shadow-lg border-orange-500 sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">Tanggal</th>
                        <th scope="col" class="py-3 px-6">Produk</th>
                        <th scope="col" class="py-3 px-6">Kategori</th>
                        <th scope="col" class="py-3 px-6">Jumlah Masuk</th>
                        <th scope="col" class="py-3 px-6">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $trx)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="py-2 px-4">{{ $trx->date->format('d-m-Y') }}</td>
                            <td class="py-2 px-4">{{ $trx->produk->name ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $trx->produk->kategori->name ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $trx->quantity }}</td>
                            <td class="py-2 px-4">{{ $trx->user->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $transaksi->links() }}
            </div>
        

        <!-- Tombol Navigasi -->
        <div class="flex flex-col sm:flex-row gap-4 mt-6">
            <form action="{{ route('admin.laporan.keluar') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 shadow transition duration-300">
                    Laporan Barang Keluar
                </button>
            </form>
            <form action="{{ route('admin.laporan.stock') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 shadow transition duration-300">
                    Laporan Stock Barang
                </button>
            </form>
            <form action="{{ route('admin.lapaktivitas') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 shadow transition duration-300">
                    Laporan Aktivitas
                </button>
            </form>
        </div>
    </div>
@endsection
