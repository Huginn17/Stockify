@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">


        <table class="min-w-full text-sm text-left shadow text-gray-700 rounded-lg overflow-hidden">
            <thead class="text-white bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4">
                    <div class="flex items-center justify-between gap-4 mb-1">
                        <h1 class="text-2xl text-white font-semibold font-sans">Supplier 🛒</h1>

                        <form method="GET" action="" class="flex items-center gap-2 max-w-[400px] w-full">
                            <input type="text" name="search" placeholder="🔍︎  Cari Nama atau Address..."
                                value="{{ request('search') }}"
                                class="flex-1 px-3 py-2 border bg-white text-gray-900 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">

                            <select name="sort" onchange="this.form.submit()" class="border p-2 w-[130px] sm:rounded-lg">
                                <option value="">Urutkan</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)
                                </option>
                            </select>
                        </form>
                    </div>

                    <tr>
                        <th scope="col" class="px-6 py-3">
                            NAMA
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ALAMAT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NO.TELEPON
                        </th>
                        <th scope="col" class="px-6 py-3">
                            EMAIL
                        </th>
                    </tr>
                </div>
            </thead>
            <tbody>
                @foreach ($supplier as $s)
                    <tr
                        class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $s->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $s->email }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
