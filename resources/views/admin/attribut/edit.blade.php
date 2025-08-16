@extends('admin.layout.main')
@section('contentadmin')
    <div class="w-full mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-white mb-6">Edit Data Attribut ✏️</h3>

        <form action="{{ route('admin.attribut.update', $attribut->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')


            <div class="mt-4">
                <label for="product_id" class="block text-sm font-medium text-white">Produk :</label>
                <select name="product_id" id="product_id"
                    class="mt-1 block w-full border border-gray-300 bg-gray-50 hover:bg-gray-200 transition duration-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($products as $produk)
                        <option value="{{ $produk->id }}" {{ $produk->id == $attribut->product_id ? 'selected' : '' }}>
                            {{ $produk->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="name" class="block text-sm font-medium text-white">Attribut :</label>
                <input type="text" name="name" id="name" value="{{ $attribut->name }}"
                    class="mt-1 block w-full border border-gray-300 bg-gray-50 hover:bg-gray-200 transition duration-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500">
            </div>


            <div>
                <label for="value" class="block text-sm font-medium text-white">Value :</label>
                <input type="text" name="value" id="value" value="{{ $attribut->value }}"
                    class="mt-1 block w-full border border-gray-300 bg-gray-50 hover:bg-gray-200 transition duration-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500">
            </div>


            <div class="flex items-center justify-between pt-4">
                <button type="submit" style="border-radius: 20vh"
                    class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md shadow transition duration-300">
                    Perbarui Attribut
                </button>

                <a href="{{ route('admin.attribut.index') }}" style="font-size: medium; text-decoration: none;"></a>
                <button type="submit" style="font-size: medium; text-decoration: none; border-radius: 20vh"
                    class="bg-orange-500 hover:bg-orange-400 text-white transition duration-300 font-bold text-sm inline-flex items-center px-4 py-2">
                    Kembali
                </button>
                </a>
            </div>
        </form>
    </div>
@endsection
