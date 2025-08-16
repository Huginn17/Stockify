@extends('admin.layout.main')
@section('contentadmin')
    <section class="bg-gray dark:bg-gray-900">
        <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 shadow-lg p-6 rounded-xl">
            <h2 class="mb-4 text-xl font-bold text-white dark:text-white">Buat Data Attribut</h2>
            <form action="{{ route('admin.attribut.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4">
                        <div>
                            <label for=""
                                class="block mb-2 text-sm font-medium text-white dark:text-white">Nama Produk :</label>
                            <select name="product_id" id=""class="bg-gray-50 hover:bg-gray-200 transition duration-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($products as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for=""
                                class="block mb-2 text-sm font-medium text-white dark:text-white">Attribut :</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 hover:bg-gray-200 transition duration-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Contoh : Warna Merah" required="">
                        </div>
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-white dark:text-white">Value :</label>
                            <input type="text" name="value" id="value"
                                class="bg-gray-50 hover:bg-gray-200 transition duration-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required="">
                        </div>
                    </div><br>
                 <div class="mt-6 flex justify-between items-center">
               <button type="submit" style="border-radius: 20vh; font-weight:bold;" class="bg-orange-500 text-white font-bold px-4 py-2 hover:bg-orange-400 transition duration-300">
              Tambah Attribut 
            </button>
            <a href="{{ route('admin.attribut.index') }}" style="font-size: medium; border-radius: 20vh; text-decoration: none;"
                class="bg-orange-500 text-white hover:bg-orange-400 py-2 px-4 font-bold inline-flex items-center transition duration-300">
                Kembali
            </a>
            </div>
            </form>
        </div>
        
    </section>
@endsection
