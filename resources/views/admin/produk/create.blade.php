@extends('admin.layout.main')
@section('contentadmin')
    <section class="bg-gray dark:bg-gray-900">
        <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="mb-6 font-bold text-white text-center dark:text-white">Tambahkan Produk Baru</h2>
            <br>
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">


                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-bold text-white dark:text-white">Nama Produk
                            :</label>
                        <input type="text" name="name" id="name" required
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name">
                    </div>


                    <div>
                        <label class="block mb-2 text-sm font-medium text-white dark:text-white">Kategori :</label>
                        <select name="category_id"
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label class="block mb-2 text-sm font-bold text-white dark:text-white">Supplier :</label>
                        <select name="supplier_id"
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="sku" class="block mb-2 text-sm font-medium text-white dark:text-white">SKU
                            :</label>
                        <input type="text" name="sku" id="sku" required
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Type SKU">
                    </div>

                    <div>
                        <label for="purchase_price" class="block mb-2 text-sm font-medium text-white dark:text-white">Harga
                            Beli :</label>
                        <input type="number" name="purchase_price" id="purchase_price" required
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Rp 10000">
                    </div>


                    <div>
                        <label for="selling_price" class="block mb-2 text-sm font-medium text-white dark:text-white">Harga
                            Jual :</label>
                        <input type="number" name="selling_price" id="selling_price" required
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Rp 15000">
                    </div>


                    <div>
                        <label for="minimum_stock" class="block mb-2 text-sm font-medium text-white dark:text-white">Minimum
                            Stok :</label>
                        <input type="number" name="minimum_stock" id="minimum_stock" required
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-white dark:text-white">Gambar
                            :</label>
                        <input type="file" name="image" id="image"
                            class="w-full text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>


                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-white dark:text-white">Deskripsi
                            :</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full p-2.5 text-sm border rounded-lg bg-white border-gray-300 text-gray-900 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Your description here..."></textarea>
                    </div>

                </div>

                <div class="mt-6 flex justify-between items-center">
                    <button type="submit" style="border-radius: 20vh; font-weight: bold;"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-orange-500 hover:bg-orange-400 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition duration-300">
                        Tambahkan Produk
                    </button>

                    <a href="{{ route('admin.produk') }}" style="font-size: medium; text-decoration: none;"
                        class="bg-orange-500  hover:bg-orange-400  rounded-full  font-semibold py-2 px-4 text-white shadow transition duration-300">
                        Kembali


                    </a>

                </div>
            </form>
        </div>
    </section>
@endsection
