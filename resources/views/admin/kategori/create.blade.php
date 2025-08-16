@extends('admin.layout.main')

@section('contentadmin')
    <section class="bg-gray dark:bg-gray-900">
        <div class="w-full mx-auto bg-gray-800 dark:bg-gray-500 rounded-xl shadow-lg p-6">
            <h2 class=" text-2xl font-extrabold text-white dark:text-white">Buat Data Kategori</h2>
            <br>
            <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4">


                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-white dark:text-white">Nama Kategori
                            :</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 hover:bg-gray-200 transition duration-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Contoh : Elektronik" required>
                    </div>


                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-white dark:text-white">Deskripsi
                            :</label>
                        <textarea name="description" id="description" rows="6"
                            class="bg-gray-50 hover:bg-gray-200 transition duration-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Tuliskan deskripsi kategori..."></textarea>
                    </div>
                </div>


                <div class="mt-6 flex justify-between items-center">
                    <form action="{{ route('admin.kategori.create') }}" method="GET">
                        <button type="submit" style="border-radius: 20vh; font-weight: bold;"
                            class="btn bg-orange-500 font-bold hover:bg-orange-400 text-white py-2 px-4 transition duration-300">
                            Tambah Kategori
                        </button>
                        <a href="{{ route('admin.kategori.index') }}"
                            style="font-size: medium; border-radius: 20vh; text-decoration: none;"
                            class="bg-orange-500 text-white hover:bg-orange-400 py-2 px-4 font-bold inline-flex items-center transition duration-300">
                            Kembali
                        </a>
                    </form>
                </div>
        </div>
        </form>
        </div>
    </section>
@endsection
