@extends('admin.layout.main')
@section('contentadmin')
    <section class=" dark:bg-gray-900 py-8 px-4">
        <div class="w-full mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h3 class="text-2xl font-bold text-white dark:text-white mb-6 text-center"> Edit Produk ✏️</h3>
            <div class="w-full mx-auto bg-gray-50 dark:bg-gray-50 rounded-xl mt-4 shadow-lg p-6">

                <br>
                <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Nama
                            Produk</label>
                        <input type="text" name="name" id="name" value="{{ $produk->name }}"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="category_id"
                                class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Kategori</label>
                            <select name="category_id" id="category_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $produk->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="supplier_id"
                                class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Supplier</label>
                            <select name="supplier_id" id="supplier_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ $supplier->id == $produk->supplier_id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="sku" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">SKU
                            Produk</label>
                        <input type="text" name="sku" id="sku" value="{{ $produk->sku }}"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label for="description"
                            class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ $produk->description }}</textarea>
                    </div>

                    <div>
                        <label for="purchase_price" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Harga
                            Beli</label>
                        <input type="number" name="purchase_price" id="purchase_price"
                            value="{{ $produk->purchase_price }}"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label for="selling_price" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Harga
                            Jual</label>
                        <input type="number" name="selling_price" id="selling_price" value="{{ $produk->selling_price }}"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label for="image" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Gambar
                            Produk</label>
                        <input type="file" name="image" id="image"
                            class="w-full text-gray-700 border shadow sm:rounded-lg dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-700">
                        @if ($produk->image)
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Gambar saat ini :
                                <strong>{{ $produk->image }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <label for="minimum_stock" class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Minimum
                            Stock</label>
                        <input type="number" name="minimum_stock" id="minimum_stock" value="{{ $produk->minimum_stock }}"
                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div class="pt-4 flex justify-between items-center">
                        <button type="submit" style="border-radius: 20vh; font-weight: bold;"
                            class="inline-flex items-center px-5 py-2.5 bg-orange-500 hover:bg-orange-400 text-white font-semibold rounded-md transition duration-300">
                            Perbarui Produk
                        </button>

                        <button type="submit" style="font-size: medium; text-decoration: none; border-radius: 20vh"
                            class="bg-orange-500 hover:bg-orange-400 text-white hover:text-blue-800 font-bold text-sm inline-flex items-center px-4 py-2 transition duration-300">
                            Kembali
                        </button>
                </form>
            </div>
        </div>
    </section>
@endsection
