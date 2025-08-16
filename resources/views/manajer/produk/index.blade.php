@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
            <div class="flex items-center justify-between gap-4 mb-1">
                <h1 class="text-2xl text-white font-semibold font-sans">Produk 📦</h1>

                <form method="GET" action="{{ route('manajer.produk') }}" class="flex items-center gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍︎  Cari produk..."
                        class="w-[220px] px-3 py-2 border bg-white text-gray-900 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">

                    <select name="sort" onchange="this.form.submit()" class="w-[130px] border p-2 sm:rounded-lg">
                        <option value="">Urutkan</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                </form>
            </div>

        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Produk</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        {{-- <th scope="col" class="px-6 py-3">Supplier</th>
                      <th scope="col" class="px-6 py-3">Sku</th> --}}
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        {{-- <th scope="col" class="px-6 py-3">Harga Beli</th>
                      <th scope="col" class="px-6 py-3">Harga Jual</th> --}}
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Minimum Stok</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $key => $p)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">{{ $p->name }}</td>
                            <td class="px-6 py-4">{{ $p->kategori->name }}</td>
                            {{-- <td class="px-6 py-4">{{ $p->supplier->name }}</td> --}}
                            {{-- <td class="px-6 py-4">{{ $p->sku }}</td> --}}
                            <td class="px-6 py-4">{{ $p->description }}</td>
                            {{-- <td class="px-6 py-4">{{ $p->purchase_price }}</td>
                          <td class="px-6 py-4">{{ $p->selling_price }}</td> --}}
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $p->image) }}" alt="" width="100">
                            </td>
                            <td class="px-6 py-4">{{ $p->minimum_stock }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route('manajer.produk.show', $p->id) }}"
                                        style="border-radius: 20vh; text-decoration: none;"
                                        class="bg-orange-500 hover:bg-orange-400 text-white font-semibold py-1 px-3 flex items-center gap-1 shadow transition duration-200">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
