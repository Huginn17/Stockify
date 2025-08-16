@extends('staff.layout.main')

@section('contentstaff')
    <div class="p-4 sm:ml-64">
        <div class="text-white p-4 bg-gray-800 sm:rounded-lg dark:bg-gray-900 shadow-lg">
            <h2 class="mb-4 text-2xl font-bold text-gray-800">Konfirmasi Transaksi Stok ✍️</h2>
        </div>
        <div class="relative overflow-x-auto mt-4 shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Catatan</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $i => $t)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4 font-bold">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">{{ $t->produk->name }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-white rounded-full font-semibold
                                {{ $t->type === 'masuk' ? 'bg-green-700' : 'bg-red-700' }}">
                                    {{ ucfirst($t->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $t->quantity }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($t->date)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 italic text-gray-500">{{ $t->notes }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                {{-- Konfirmasi --}}
                                <form method="POST" action="{{ route('staff.konfirmasi.update', $t->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status"
                                        value="{{ $t->type === 'masuk' ? 'Diterima' : 'Dikeluarkan' }}">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="flex items-center gap-1 bg-green-700 hover:bg-green-600 text-white px-3 py-1 shadow font-semibold">
                                        ✅ Konfirmasi
                                    </button>
                                </form>

                                {{--tolak --}}
                                <form method="POST" action="{{ route('staff.konfirmasi.update', $t->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="flex items-center gap-1 bg-red-700 hover:bg-red-600 text-white px-3 py-1 shadow font-semibold">
                                        ❌ Tolak
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
