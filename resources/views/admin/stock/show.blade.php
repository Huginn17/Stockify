@extends('admin.layout.main')
@section('contentadmin')
    <div class="sm:ml-60">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4 flex justify-between items-center">
            <h3 class="text-xl text-white font-bold">
                Detail Opname : {{ $produk->name }}
            </h3>
              <form action="{{ route('admin.opname') }}" method="GET">
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300">
            Kembali
        </button>
    </form>
            </div> 
               <div class="relative flex overflow-x-auto shadow-lg sm:rounded-lg ">
                  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-400 dark:bg-blue-700 dark:text-gray-400">
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
                        <tr  class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:-gray-700 border-gray-200">
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
@endsection
