@extends('admin.layout.main')
@section('contentadmin')

  <link rel="stylesheet" href="style.css">
<div class="bg-blue-900 w-full p-4 rounded-sm shadow text-white" style="font-weight: 40px; text-align: center; font-size: 250%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>Manajemen Data</b><br>
<hr border="1" color="white">
  <div  style="font-weight: 20px; text-align: center; font-size: 40%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <form action="{{ route('admin.kategori.index') }}" method="GET">
        <button type="submit" style="margin-bottom: 10px" class=" px-4 py-2  bg-blue-500 text-white rounded hover:bg-blue-200">
            Kategori
        </button>
    </form>

    <form action="{{ route('admin.supplier.index') }}" method="GET">
        <button type="submit" style="margin-bottom: 10px" class=" px-4 py-2  bg-blue-500 text-white rounded hover:bg-blue-200">
            Supplier
        </button>
    </form>

    <form action="{{ route('admin.attribut.index') }}" method="GET">
        <button type="submit" style="margin-bottom: 10px" class=" px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-200">
            Attribut
        </button>
    </form>
  </div>
</div>

    <div class="flex flex-col gap-4">
    <a href="{{ route('admin.produk.export') }}" class="" style="margin-left: 88%; font-weight: bold">Export Produk</a>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-blue-700 dark:text-gray-400">
               



                <!-- Tambahkan ini di <head> -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Supplier
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Sku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Harga Beli
                    </th> --}}
                    {{-- <th scope="col" class="px-6 py-3">
                        Harga Jual
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Gambar
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Minimum Stock
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allproduk as $key => $p)
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $p->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $p->kategori->name }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{ $p->supplier->name }}
                        </td> --}}
                        <td class="px-6 py-4">
                            {{ $p->sku }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $p->description }}
                        </td>
                        {{-- <td class="px-6 py-4">
                            {{ $p->purchase_price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $p->selling_price }}
                        </td> --}}
                        <td><img src="{{ asset('storage/' . $p->image) }}" alt="" width="100"></td>
                        {{-- <td class="px-6 py-4">
                            {{ $p->minimum_stock }}
                        </td> --}}
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST">
                                <a href="{{ route('admin.produk.show', $p->id) }}" class="tombol">Detail</a>
                              <a href="{{ route('admin.produk.edit', $p->id) }}" class="tombol">
                                    <i class="fas fa-edit"></i>
                                  

                             
   @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow flex items-center gap-2">
        <i class="fas fa-trash-alt"></i>
        Hapus
    </button>
</form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    
    
    <a href="{{ route('admin.produk.create') }}" class="btn" style="margin-bottom: 10px; font-weight: bold; margin-right: 90%">Tambah Produk + </a>
    
                <form action="{{ route('admin.produk.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload File</label>
               <form action="{{ route('admin.produk.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        aria-describedby="file_input_help"
        id="file_input"
        type="file"
        name="file"
        required
    >

</form>
<button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-200"> Import Produk </button>
            
@endsection
