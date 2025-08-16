@extends('manajer.layout.main')
@section('contentmanajer')
    <div class="p-4 sm:ml">
        <div class="p-10 sm:ml-64 mt-4 bg-gray-800 sm:rounded-lg">
            <div class="p-10 bg-red-600 sm:rounded-lg">
                <div class="bg-yellow-400 shadow-md rounded-xl p-6">
                    <h1 style="font-size: 35px;" class="text-black font-bold font-sans text-center mt-2">Management Transaksi
                        Barang</h1>
                    <hr border="1" class="mt-5">
                    <div class="flex gap-4 justify-center mt-4">
                        <a href="{{ route('manajer.stock.create') }}" style="font-weight: bold; text-decoration: none;"
                            class="bg-gray-800 text-white hover:bg-red-600 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg border-white transition duration-300">
                            Barang Masuk +
                        </a>

                        <a href="{{ route('manajer.stock.keluar.create') }}"
                            style="font-weight: bold; text-decoration: none;"
                            class="bg-gray-800 text-white hover:bg-red-600 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg border-white transition duration-300">
                            Barang Keluar -
                        </a>

                        <a href="{{ route('manajer.opname') }}" style="font-weight: bold; text-decoration: none;"
                            class="bg-gray-800 text-white hover:bg-red-600 hover:text-white font-bold py-2 px-5 rounded-full shadow-lg border-white transition duration-300">
                            Opname
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
