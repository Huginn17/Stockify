@extends('admin.layout.main')
@section('contentadmin')
    <link rel="stylesheet" href="style.css">


    <div class="text-white sm:rounded-lg dark:bg-gray-900 p-2 shadow-lg bg-gray-800"
        style="font-weight: 25px; text-align: center; font-size: 200%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">


        <div
            style="display: flex; justify-content: space-between; align-items: center; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 18px;">
            <form action="{{ route('admin.kategori.index') }}" method="GET">
                <button type="submit" style="border-radius: 20vh;"
                    class="bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
                    {{ request()->routeIs('admin.kategori.index') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
                    Kategori
                </button>
            </form>
            <form action="{{ route('admin.produk') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-0 text-orange-500 hover:bg-orange-500 fokus:bg-orange-500 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700  hover:scale-105 transition duration-300
                    {{ request()->routeIs('admin.produk') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
                    Produk
                </button>
                {{-- <hr border="1" color="white">  --}}
            </form>
            <form action="{{ route('admin.attribut.index') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
                    {{ request()->routeIs('admin.attribut.index') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
                    Attribut
                </button>
            </form>
        </div>
    </div>
    <br>
    <hr border="1">
    <div class="flex items-center justify-between mb-4">
        {{-- Search  --}}
        <form method="GET" action="{{ route('admin.produk') }}" class="flex items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍︎  Cari produk..."
                class="w-[220px] px-3 py-2 border bg-gray-0 text-gray-900 hover:bg-gray-100 shadow-sm transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">

            <select name="sort" onchange="this.form.submit()"
                class="w-[150px] border bg-gray-0 hover:bg-gray-100 transition duration-300 shadow-sm p-2 sm:rounded-lg">
                <option value="">Urutkan</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
            </select>
        </form>


        <a href="{{ route('admin.produk.export') }}" style="text-decoration: none;" class="text-gray-800 hover:text-gray-700 font-bold">
            Export Produk ⭡
        </a>
    </div>

    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Produk</th>
                    <th scope="col" class="px-6 py-3">Kategori</th>
                    <!-- <th scope="col" class="px-6 py-3">Supplier</th> -->
                    <!-- <th scope="col" class="px-6 py-3">Sku</th> -->
                    <th scope="col" class="px-6 py-3">Deskripsi</th>
                    <!-- <th scope="col" class="px-6 py-3">Harga Beli</th> -->
                    <!-- <th scope="col" class="px-6 py-3">Harga Jual</th> -->
                    <th scope="col" class="px-6 py-3">Gambar</th>
                    <!-- <th scope="col" class="px-6 py-3">Minimum Stok</th> -->
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allproduk as $key => $p)
                    <tr
                        class="odd:bg-white hover:bg-gray-100 transition duration-300 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">{{ $p->name }}</td>
                        <td class="px-6 py-4">{{ $p->kategori->name }}</td>
                        <!-- <td class="px-6 py-4">{{ $p->supplier->name }}</td> -->
                        <!-- <td class="px-6 py-4">{{ $p->sku }}</td> -->
                        <td class="px-6 py-4">{{ $p->description }}</td>
                        <!-- <td class="px-6 py-4">{{ $p->purchase_price }}</td> -->
                        <!-- <td class="px-6 py-4">{{ $p->selling_price }}</td> -->
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $p->image) }}" alt="" width="100">
                        </td>
                        <!-- <td class="px-6 py-4">{{ $p->minimum_stock }}</td> -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 flex-wrap">
                                <form action="{{ route('admin.produk.show', $p->id) }}" method="GET"
                                    class="inline-block">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-gray-800 hover:bg-gray-600 text-white font-semibold py-1 px-3 flex items-center shadow gap-1 transition duration-300">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </form>


                                <form action="{{ route('admin.produk.edit', $p->id) }}" method="GET"
                                    class="inline-block">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-1 px-3 flex items-center shadow gap-1 transition duration-300">
                                        <i class="fas fa-edit"></i>Edit
                                    </button>
                                </form>


                                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-red-600 hover:bg-red-500 text-white font-semibold py-1 px-3 text-sm flex items-center shadow gap-1 transition duration-300">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.produk.create') }}" class="text-gray-800 hover:text-gray-700"
            style="margin-bottom: 10px; font-weight: bold;  text-decoration: none; text-gray-500">Tambah Produk +</a>
    </div>

    <hr border="1">
    <form action="{{ route('admin.produk.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white" for="file_input">Upload File</label>
        <form action="{{ route('admin.produk.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input
                class="block w-full text-sm text-gray-900 border-gray-300 sm:rounded-lg transition duration-300 cursor-pointer bg-gray-100 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"aria-describedby="file_input_help"
                id="file_input" type="file" name="file" required>

            <button type="submit" style="border-radius: 20vh"
                class="mt-4 bg-gray-800 text-white px-4 py-2 hover:bg-gray-700 font-bold transition duration-300">Import
                Produk </button>

        </form>
    @endsection
