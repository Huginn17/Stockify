@extends('staff.layout.main')
@section('contentstaff')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-gray-800 rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-white ">Riwayat Stock Opname 🗳️</h1>
            </div>
            <form action="{{ route('staff.dashboard') }}" method="GET"><br>
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-500 text-white hover:bg-orange-700 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
                    Kembali
                </button>
            </form>
        </div>

        <div class="mt-10 overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm text-left text-gray-800">
                <thead class="text-xs uppercase bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Referensi</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Stock Sistem</th>
                        <th class="px-6 py-3">Stock Fisik</th>
                        <th class="px-6 py-3">Selisih</th>
                        <th class="px-6 py-3">Petugas</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($opnametransaksi as $o)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o->date->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o->produk->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="text-xs font-bold px-3 py-1 rounded-full 
                                    {{ $o->type == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($o->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $o->type == 'masuk' ? $o->produk->current_stock - $o->quantity : $o->produk->current_stock + $o->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $o->produk->current_stock }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap font-semibold 
                                {{ $o->type == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $o->type == 'masuk' ? '+' . $o->quantity : '-' . $o->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o->user->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat stock opname
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $opnametransaksi->links() }}
        </div>


    </div>
@endsection
