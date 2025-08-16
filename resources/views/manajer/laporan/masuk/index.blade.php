@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <!-- Header & Filter -->
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-semibold text-white ">Laporan Barang Masuk 📝</h2>
            </div>

            <form method="GET" class="flex flex-wrap gap-4 items-center">
                <div class="flex items-end gap-4">

                    <!-- Tanggal Mulai -->
                    <div class="flex flex-col">
                        <label for="tanggal_mulai" class="mb-2 text-sm font-medium text-white">Tanggal Mulai :</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 bg-gray-0 hover:bg-gray-100 transition duration-300" />
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="flex flex-col">
                        <label for="tanggal_selesai" class="mb-2 text-sm font-medium text-white">Tanggal Selesai :</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                            class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 bg-gray-0 hover:bg-gray-100 transition duration-300" />
                    </div>

                    <!-- Tombol Filter -->
                    <div>
                        <button type="submit" style="border-radius: 20vh"
                            class="bg-orange-500 text-white font-bold px-4 py-2 rounded-md hover:bg-orange-400 transition duration-300">
                            Filter
                        </button>
                    </div>`
                </div>

            </form>
        </div>

        <!-- Tabel -->

        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">Tanggal</th>
                        <th scope="col" class="py-3 px-6">Produk</th>
                        <th scope="col" class="py-3 px-6">Kategori</th>
                        <th scope="col" class="py-3 px-6">Jumlah Masuk</th>
                        <th scope="col" class="py-3 px-6">Petugas</th>
                        <th scope="col" class="py-3 px-6">Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $t)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="py-2 px-4">{{ $t->date->format('d-m-Y') }}</td>
                            <td class="py-2 px-4">{{ $t->produk->name ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $t->produk->kategori->name ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $t->quantity }}</td>
                            <td class="py-2 px-4">{{ $t->user->name ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $t->supplier->name ?? '-' }}</td>
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
            <form action="{{ route('manajer.laporan.keluar') }}" method="GET">
                <button type="submit"
                    class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 rounded-full shadow transition duration-300">
                    Laporan Barang Keluar
                </button>
            </form>
            <form action="{{ route('manajer.laporan.stock') }}" method="GET">
                <button type="submit"
                    class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 rounded-full shadow transition duration-300">
                    Laporan Stock Barang
                </button>
            </form>
        </div>


    </div>
@endsection
