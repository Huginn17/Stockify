@extends('admin.layout.main')
@section('contentadmin')
    <link rel="stylesheet" href="style.css">
    <div
        class="text-white p-4 bg-gray-800 sm:rounded-lg dark:bg-gray-900 shadow-sm flex items-center justify-between gap-4 mb-1">
        <h2 class="text-2xl text-white font-semibold font-sans">Pengguna 👥</h2>
        <form method="GET" action="" class="flex-1 max-w-[300px]">
            <input type="text" name="search" placeholder="🔍︎  Cari Nama atau role ..." value="{{ request('search') }}"
                class="w-full px-3 py-2 border bg-gray-0 text-gray-900 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
        </form>
    </div>

    <br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <tr
                        class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
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
                            <div class="flex gap-2">

                                <form action="{{ route('admin.pengguna.show', $e->id) }}" method="GET"
                                    style="display: inline;">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-1 px-3 transition duration-300">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </form>


                                <form action="{{ route('admin.pengguna.edit', $e->id) }}" method="GET"
                                    style="display: inline;">
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-yellow-500 hover:bg-yellow-400 text-white font-semibold py-1 px-3 transition duration-300">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>


                                <form action="{{ route('admin.pengguna.destroy', $e->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border-radius: 20vh"
                                        class="bg-red-500 hover:bg-red-400 text-white font-semibold py-1 px-3 transition duration-300">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>


                                <form action="{{ route('admin.pengguna.reset', $e->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin reset password {{ $e->name }} ke default (123)?')">
                                    @csrf
                                    @method('PUT')
                                    <!-- Tombol Reset (buka modal) -->
                                    <button type="button" data-modal-target="resetModal-{{ $e->id }}"
                                        data-modal-toggle="resetModal-{{ $e->id }}" style="border-radius: 20vh"
                                        class="bg-red-500 hover:bg-red-400 text-white font-semibold px-3 py-1 shadow">
                                        Reset Password
                                    </button>

                                    <!-- Modal -->
                                    <div id="resetModal-{{ $e->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                            <h3 class="text-lg font-bold mb-4">Konfirmasi Reset Password</h3>
                                            <p>Apakah Anda yakin ingin mereset password <b>{{ $e->name }}</b> ke
                                                default <code>123</code>?</p>

                                            <div class="mt-6 flex justify-end gap-2">
                                                <button type="button" data-modal-hide="resetModal-{{ $e->id }}"
                                                    class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">
                                                    Batal
                                                </button>

                                                <form action="{{ route('admin.pengguna.reset', $e->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">
                                                        Reset
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                @endforeach
            </tbody>
        </table>
    </div><br>
    <a href="{{ route('admin.pengguna.create') }}"  class="mt-4 text-gray-800 px-4 py-2 hover:text-gray-700 font-bold transition duration-300" style="font-weight: bold; text-decoration: none;">Tambah
            Pengguna +</a>
    @endsection
