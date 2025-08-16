@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml-64">
        <div class="p-4 max-w-xs space-y-4">
            @if (session('success'))
                <div class="bg-green-300 p-3 mb-3 sm:rounded-lg shadow-lg text-white font-bold">{{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="bg-red-400 p-3 mb-3 sm:rounded-lg shadow-lg text-white font-bold">{{ session('error') }}</div>
            @endif
        </div>

        <section class="bg-gray-800 dark:bg-gray-900 sm:rounded-lg">
            <div class="mx-auto bg-gray-800 dark:bg-gray-800 rounded-xl shadow-lg  p-6 ">
                <h2 class="mb-4 text-2xl font-bold text-white dark:text-white text-center">Barang Masuk</h2>
                <div class=" p-10 bg-gray-50 sm:rounded-lg">
                    <form action="{{ route('manajer.stock.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="product_id" class="block mb-2 text-sm font-medium text-black dark:text-white">Produk
                                :</label>
                            <select name="product_id" id="product_id"
                                class="bg-white  border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-800 dark:placeholder-gray-800 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                            <div class="w-full">
                                <label for="quantity"
                                    class="block mb-2 text-sm font-medium text-black dark:text-black">Jumlah
                                    Masuk :</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="bg-white border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="" required="">
                            </div>

                            <div>
                                <label for="date"
                                    class="block mb-2 text-sm font-medium text-black dark:text-black">Tanggal
                                    Masuk :</label>
                                <input type="datetime-local" name="date" id="date"
                                    value="{{ old('date', now()->format('Y-m-d\TH:i')) }}"
                                    class="bg-white  border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="" required="">
                            </div>
                            <div>
                                <label for="supplier_id"
                                    class="block mb-2 text-sm font-medium text-black dark:text-black">Supplier :</label>
                                <select name="supplier_id" id="supplier_id"
                                    class="bg-white  border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="notes"
                                    class="block mb-2 text-sm font-medium text-black dark:text-black">Catatan :</label>
                                <textarea name="notes" id="notes" rows="8"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg  border-gray-800 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Tulis Catatan"></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between items-center">
                            <button type="submit" style="border-radius: 20vh"
                                class="bg-orange-500 hover:bg-orange-800 text-white font-bold py-2 px-4 rounded-full transition duration-200">
                                Konfirmasi
                            </button>

                            <a href="{{ route('manajer.stock') }}" style="font-size: semibold; text-decoration: none;"
                                class="bg-orange-500 hover:bg-orange-600 btn rounded-full font-bold text-white">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
