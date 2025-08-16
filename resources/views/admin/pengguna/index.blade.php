@extends('admin.layout.main')
@section('contentadmin')
    <link rel="stylesheet" href="style.css">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
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
                @foreach ($allpengguna as $key => $e)
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $e->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $e->role }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $e->email }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.pengguna.destroy', $e->id) }}" method="POST">
                                <a href="{{ route('admin.pengguna.show', $e->id) }}" class="tombol">Detail</a>
                                <a href="{{ route('admin.pengguna.edit', $e->id) }}" class="tombol">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><br>
    <div class="flex flex-col gap-4">
    <a href="{{ route('admin.pengguna.create') }}" class="btn" style="margin-left: 83%; font-weight: bold;">Tambah Pengguna +</a>
@endsection
