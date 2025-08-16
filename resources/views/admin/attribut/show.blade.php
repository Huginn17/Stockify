@extends('admin.layout.main')
@section('contentadmin')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-white flex items-center mb-6">
            Detail Attribut ⓘ
        </h2>
        <br>
        <div class="mb-4">
            <div class="bg-gray-50 hover:bg-gray-200 transition duration-300 p-3 rounded-md flex justify-between shadow-md">
                <span class="font-medium text-gray-700">Produk :</span>
                <span class="text-gray-800">{{ $attribut->produk->name }}</span>
            </div>
        </div>

        <div class="mb-4">
            <div class="bg-gray-50 hover:bg-gray-200 transition duration-300 p-3 rounded-md flex justify-between shadow-md">
                <span class="font-medium text-gray-700">Attribut :</span>
                <span class="text-gray-800">{{ $attribut->name }}</span>
            </div>
        </div>

        <div class="mb-6">
            <div class="bg-gray-50 hover:bg-gray-200 transition duration-300 p-3 rounded-md flex justify-between shadow-md">
                <span class="font-medium text-gray-700">Value :</span>
                <span class="text-gray-800">{{ $attribut->value }}</span>
            </div>
        </div>

        <a href="{{ route('admin.attribut.index') }}" style="text-decoration: none;">
            <button type="submit" style="font-size: medium; text-decoration: none; border-radius: 20vh"
                class="bg-orange-500 hover:bg-orange-400 text-white transition duration-300 font-bold text-sm inline-flex items-center px-4 py-2">
                Kembali
            </button>
        </a>
    </div>
    </div>
@endsection
