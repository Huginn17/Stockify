@extends('admin.layout.main')
@section('contentadmin')
    <section class="bg-gray dark:bg-gray-900">
        <div class="w-full mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-lg">
            <h3 class="mb-4 text-xl font-bold text-white dark:text-white">Update Data Kategori ✏️</h3>
            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4">
                    <div cl>
                        <label for="name" class="block mb-2 text-sm font-medium text-white dark:text-white">
                            Nama Kategori :
                        </label>
                        <input type="text" name="name" id="name" value="{{ $kategori->name }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required>
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-white dark:text-white">
                            Deskripsi :
                        </label>
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $kategori->description }}</textarea>
                    </div>
                </div>
                <br>
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf

                    <div class="mt-6 flex justify-between items-center">
                        <button type="submit" style="border-radius: 20vh"
                            class="bg-orange-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                            Perbarui Kategori
                        </button>

                        <form action="{{ route('admin.kategori.index') }}" method="GET"><br>
                            <button type="submit" style="border-radius: 20vh"
                                class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg - transition duration-300">
                                Kembali
                            </button>
                        </form>
                    </div>
                </form>

            </form>
        </div>
    </section>
@endsection
