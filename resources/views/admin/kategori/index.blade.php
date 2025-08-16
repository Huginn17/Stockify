@extends('admin.layout.main')
@section('contentadmin')
    <div class="text-white sm:rounded-lg dark:bg-gray-900 p-2 shadow-lg bg-gray-800"
        style="font-weight: 25px; text-align: center; font-size: 250%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        
        {{--  <hr border="1" color="white">  --}}

        <div class=""
            style="display: flex; justify-content: space-between; align-items: center; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 18px;">
            <form action="{{ route('admin.kategori.index') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700  hover:scale-105 transition duration-300
                    {{ request()->routeIs('admin.kategori.index') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
                    Kategori
                </button>
            </form>

            <form action="{{ route('admin.produk') }}" method="GET">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white  font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
                    {{ request()->routeIs('admin.produk') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
                    Produk
                </button>
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
 <form method="GET" action="" class="flex items-center gap-4">
    <input type="text" name="search" placeholder="🔍︎  Cari Nama atau Address ..." 
        value="{{ request('search') }}"
        class="w-[300px] px-3 py-2 shadow-sm border bg-gray-0 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">

    <select name="sort" onchange="this.form.submit()" 
        class="w-[150px] border p-2 sm:rounded-lg shadow-sm bg-gray-0 hover:bg-gray-100 transition duration-300">
        <option value="">Urutkan</option>
        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
    </select>
</form>
<br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($allkategori as $key => $k)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $k->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $k->description }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">

                                <form action="{{ route('admin.kategori.show', $k->id) }}" method="GET"
                                    class="inline-block">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-gray-800 hover:bg-gray-600 text-white text-sm font-semibold py-1 px-3  flex items-center gap-1 shadow transition duration-300">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </form>


                                <form action="{{ route('admin.kategori.edit', $k->id) }}" method="GET"
                                    class="inline-block">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-1 px-3 flex items-center gap-1 shadow transition duration-300">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>


                                <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-red-600 hover:bg-red-500 text-white text-sm font-semibold py-1 px-3 flex items-center gap-1 shadow transition duration-300">
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
    <br>
    <a href="{{ route('admin.kategori.create') }}" class="btn text-gray-800 hover:text-gray-700"
        style="font-weight: bold; text-decoration: none;">Tambah Kategori +</a>
@endsection
