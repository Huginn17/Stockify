@extends('admin.layout.main')
@section('contentadmin')

<div class="max-w-3xl mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-lg">
        <h3 class="text-white font-semibold flex items-center mb-6">
            Detail Data Supplier 
        </h3>
        <br>
        <div class="mb-4">
            <div class="bg-gray-50 p-3 rounded-md flex justify-between shadow-md transition duration-300 hover:bg-gray-200">
                <span class="font-medium text-gray-700">Nama Supplier :</span>
                <span class="text-gray-800">{{ $supplier->name }}</span>
            </div>
        </div>

        <div class="mb-4">
            <div class="bg-gray-50 p-3 rounded-md flex justify-between shadow-md transition duration-300 hover:bg-gray-200">
                <span class="font-medium text-gray-700">Alamat :</span>
                <span class="text-gray-800 ">{{ $supplier->address }}</span>
            </div>
        </div>

        <div class="mb-4">
            <div class="bg-gray-50 p-3 rounded-md flex justify-between shadow-md transition duration-300 hover:bg-gray-200">
                <span class="font-medium text-gray-700 ">No. Telepon :</span>
                <span class="text-gray-800">{{ $supplier->phone }}</span>
            </div>
        </div>

        <div class="mb-6">
            <div class="bg-gray-50 p-3 rounded-md flex justify-between shadow-md transition duration-300 hover:bg-gray-200">
                <span class="font-medium text-gray-700">Email :</span>
                <span class="text-gray-800">{{ $supplier->email }}</span>
            </div>
        </div>

      <form action="{{ route('admin.supplier.index') }}" method="GET"><br>
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
            Kembali
        </button>
    </form>
    </div>
</div>

@endsection
