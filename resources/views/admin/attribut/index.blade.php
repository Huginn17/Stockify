@extends('admin.layout.main')
@section('contentadmin')
    <link rel="stylesheet" href="style.css">
    <div class="text-white sm:rounded-lg dark:bg-gray-900 p-2 shadow-lg bg-gray-800"
        style="font-weight: 40px; text-align: center; font-size: 250%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">

<div style="display: flex; justify-content: space-between; align-items: center; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 18px;">
    <form action="{{ route('admin.kategori.index') }}" method="GET">
        <button type="submit" style="border-radius: 20vh"
            class="font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
            {{ request()->routeIs('admin.kategori.index') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
            Kategori
        </button>
    </form>

    <form action="{{ route('admin.produk') }}" method="GET">
        <button type="submit" style="border-radius: 20vh"
            class="font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
            {{ request()->routeIs('admin.produk') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
            Produk
        </button>
    </form>

    <form action="{{ route('admin.attribut.index') }}" method="GET">
        <button type="submit" style="border-radius: 20vh"
            class="font-bold py-2 px-5 rounded-full shadow-lg ring-1 ring-gray-700 hover:scale-105 transition duration-300
            {{ request()->routeIs('admin.attribut.index') ? 'bg-orange-500 text-white' : 'bg-orange-0 text-orange-500 hover:bg-orange-500 hover:text-white' }}">
            Attribut
        </button>
    </form>
</div>

    </div>
    <br>
    <form method="GET" action="" class="flex items-center gap-4">
        <input type="text" name="search" placeholder="🔍︎  Cari Nama atau Address ..." value="{{ request('search') }}"
            class="w-[300px] px-3 py-2 shadow-sm border bg-gray-0 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
        <select name="sort" onchange="this.form.submit()" class="w-[150px] border p-2 sm:rounded-lg shadow-sm">
            <option value="">Urutkan</option>
            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)
            </option>
            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)
            </option>
            </option>
        </select>
    </form><br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Attribut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Value
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allattribut as $key => $a)
                    <tr class="bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $a->produk->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $a->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $a->value }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">

                                <form action="{{ route('admin.attribut.show', $a->id) }}" method="GET"
                                    class="inline-block">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-gray-800 hover:bg-gray-700 text-white text-sm font-semibold py-1 px-3 flex items-center gap-1 transition duration-300">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </form>


                                <form action="{{ route('admin.attribut.edit', $a->id) }}" method="GET"
                                    class="inline-block ml-2">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-semibold py-1 px-3 flex items-center gap-1 shadow-lg transition duration-300">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>


                                <form action="{{ route('admin.attribut.destroy', $a->id) }}" method="POST"
                                    class="inline-block ml-2"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-red-600 hover:bg-red-500 text-white text-sm font-semibold py-1 px-3 flex items-center gap-1 shadow-lg transition duration-300">
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
    <a href="{{ route('admin.attribut.create') }}" class="text-gray-800 hover:text-gray-700"
        style="font-weight: bold; text-decoration: none; ">Tambahkan
        Attribut +</a>
@endsection
