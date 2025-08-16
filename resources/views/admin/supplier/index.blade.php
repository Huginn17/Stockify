@extends('admin.layout.main')
@section('contentadmin')
    <link rel="stylesheet" href="style.css">
    <div
        class="text-white p-4 bg-gray-800 sm:rounded-lg dark:bg-gray-900 shadow-sm flex items-center justify-between gap-4 mb-1">
        <h2 class="text-2xl text-white font-semibold font-sans">Supplier 🛒</h2>
        <form method="GET" action="" class="flex-1 max-w-[300px]">
            <input type="text" name="search" placeholder="🔍︎  Cari Nama atau Address ..." value="{{ request('search') }}"
                class="w-full px-3 py-2 border bg-gray-50 text-gray-900 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
        </form>
    </div>

    <br>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded">
            <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Supplier
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No.Telepon
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allsupplier as $key => $s)
                    <tr
                        class="odd:bg-white hover odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.supplier.destroy', $s->id) }}" method="POST">


                                <div class="flex gap-2">

                                    <a href="{{ route('admin.supplier.show', $s->id) }}"
                                        style="border-radius: 20vh" class="bg-gray-700 hover:bg-gray-500 text-white font-semibold py-1 px-3 transition duration-300">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>


                                    <a href="{{ route('admin.supplier.edit', $s->id) }}"
                                        style="border-radius: 20vh"  class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 transition duration-300">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>


                                    <form action="{{ route('admin.supplier.destroy', $s->id) }}"
                                        method="POST"style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"style="border-radius: 20vh"
                                            class="bg-red-500 hover:bg-red-800 text-white font-semibold py-1 px-3 flex items-center gap-1 shadow transition duration-200">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
    </div>
    </td>
    </tr>
    @endforeach

    </tbody>
    </table>
    </div><br>
   <a href="{{ route('admin.supplier.create') }}"  class="mt-4 text-gray-800 px-4 py-2 hover:text-gray-700 font-bold transition duration-300" style="font-weight: bold; text-decoration: none;">Tambah
            Supplier +</a>
@endsection
