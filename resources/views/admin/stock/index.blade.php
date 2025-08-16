@extends('admin.layout.main')
@section('contentadmin')
<div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
    <div class="flex items-center justify-between mb-4">
    <h3 class="text-xl text-white font-bold">Riwayat Transaksi Barang 📝</h3>
    </div>
    {{-- filnya --}}
    <form method="GET" class="flex flex-wrap gap-4 items-center" >
       <div class="flex items-end gap-4">
        <div class="flex flex-col">
          <label for="type" class="text-white font-semibold">Tipe : </label>
          <select name="type" class="border p-2 w-36 rounded shadow-sm hover:bg-gray-50">
            <option value="">Semua Tipe  </option>
            <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
            <option value="keluar" {{ request('type') == 'keluar' ? 'selected' : '' }}>Keluar</option>
          </select>
        </div>
        <div class="flex flex-col">
          <label for="tanggal_mulai" class="text-white font-semibold">Tanggal Mulai : </label>
          <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="border p-2 bg-gray-0 rounded shadow-sm hover:bg-gray-100 transition duration-300">
        </div>
        <div class="flex flex-col">
          <label for="tanggal_selesai" class="text-white font-semibold">Tanggal Selesai : </label>
          <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="border p-2 shadow-sm bg-gray-0 rounded hover:bg-gray-100 transition duration-300">
        </div>
        <div>
           <button type="submit" class="bg-orange-500 font-bold hover:bg-orange-400 text-white px-5 py-2 transition duration-300" style="border-radius: 20vh;">Filter </button>
        </div>
       </div> 
    </form>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
         <thead class="text-sm text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="p-4">TANGGAL</th>
                <th class="p-4">PRODUK</th>
                <th class="p-4">TYPE</th>
                <th class="p-4">JUMLAH</th>
                <th class="p-4">STATUS</th>
                <th class="p-4">PENGGUNA</th>
                <th class="p-4">CATATAN</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tran as $t)
                <tr  class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200 hover:bg-gray-100">
                    <td class="p-4">{{ $t->date->format('d M Y H:i') }}</td>
                    <td class="p-4">{{ $t->produk->name ?? '-' }}</td>
                    <td class="p-4 capitalize">{{ $t->type }}</td>
                    <td class="p-4">{{ $t->quantity }}</td>
                    <td class="p-4">{{ $t->status }}</td>
                    <td class="p-4">{{ $t->user->name ?? '-' }}</td>
                    <td class="p-4">{{ $t->notes ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-4">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    <div class="mt-4">
        {{ $tran->links() }}
    </div>

<br>
<hr border="1">
<br>
    {{-- MINSTOCK --}}

    <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
        <h3 class="text-xl font-semibold text-white">Pengaturan Stock Minimum 📊 </h3>
    </div>
        @if (session('success'))
            <div class="p-2 mb-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.minstock.update') }}">
            @csrf
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full table-auto text-sm border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-4">NAMA</th>
                        <th class="p-4">SKU</th>
                        <th class="p-4">DESKRIPSI</th>
                        <th class="p-4">HARGA BELI</th>
                        <th class="p-4">HARGA JUAL</th>
                        <th class="p-4">IMAGE</th>
                        <th class="p-4">MINIMUM STOK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                        <tr  class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200 hover:bg-gray-100">
                            <td class="p-4">{{ $p->name }}</td>
                            <td class="p-4">{{ $p->sku }}</td>
                            <td class="p-4">{{ $p->description }}</td>
                            <td class="p-4">{{ number_format($p->purchase_price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ number_format($p->selling_price, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @if ($p->image)
                                    <img src="{{ asset('storage/' . $p->image) }}"
                                        class="w-12 h-12 object-cover">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </form>
                            <td class="p-4">
                                <div class="flex gap-1">
                                    {{-- Form untuk kurangi --}}
                                    <form action="{{ route('admin.minstock.turun', $p->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-orange-500 rounded text-white">−</button>
                                    </form>

                                    {{-- Input readonly --}}
                                    <input type="text" value="{{ $p->minimum_stock }}" readonly
                                        class="px-1 py-1 w-12 text-center border rounded">

                                    {{-- Form untuk tambah --}}
                                    <form action="{{ route('admin.minstock.ningkat', $p->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-orange-500 rounded text-white">+</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
      <br>
    <form action="{{ route('admin.opname') }}" method="GET">
        <button type="submit" style="border-radius: 20vh"
            class="bg-gray-800 text-white hover:bg-gray-600 hover:text-white font-semibold py-2 px-6 rounded-full shadow transition duration-300">
            Opname
        </button>
    </form>
@endsection
