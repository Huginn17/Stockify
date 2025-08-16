@extends('admin.layout.main')
@section('contentadmin')
    <section class="bg-gray dark:bg-gray-900">
        <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="mb-4 text-white font-bold dark:text-white">Tambah Pengguna Baru</h2>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pengguna.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="" class="block mb-2 text-sm font-medium text-white dark:text-white">Nama
                            :</label>
                        <input type="text" name="name" id="name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required="">
                    </div>

                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-white dark:text-white">Role
                            :</label>
                        <select name="role" id="role"
                            class="bg-white border border-gray-700  text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled class="text-gray-800">Pilih Role</option>
                            <option value="admin" class="text-gray-800">Admin</option>
                            <option value="manajer_cabang" class="text-gray-800">Manajer</option>
                            <option value="staff_gudang" class="text-gray-800">Staff</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="" class="block mb-2 text-sm font-medium text-white dark:text-white">Email
                            :</label>
                        <input type="email" name="email" id="email"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required="">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="" class="block mb-2 text-sm font-medium text-white dark:text-white">Password
                            :</label>
                        <input type="password" name="password" id="password"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required="">
                    </div>
                </div>
                <br>
                <div class="mt-6 flex justify-between items-center">
                    <form action="{{ route('admin.kategori.create') }}" method="GET">
                        <button type="submit" style="border-radius: 20vh; font-weight: bold;"
                            class="btn bg-orange-500 font-bold hover:bg-gray-700 text-white py-2 px-4 transition duration-300">
                            Tambah Pengguna
                        </button>
                        <a href="{{ route('admin.pengguna.index') }}" style="font-size: medium; text-decoration: none;"
                            class="bg-orange-500 text-white hover:bg-gray-700 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
                            Kembali
                        </a>

                </div>
            </form>
        </div>
    </section>
@endsection
