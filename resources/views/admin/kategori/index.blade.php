@extends('admin.layout.main')
@section('contentadmin')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allkategori as $key => $k) 
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $key + 1 }}
                </th>
                <td class="px-6 py-4">
                    {{ $k->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $k->description }}
                </td>
                <td class="px-6 py-4">
                     <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST">
                        <a href="{{ route('admin.kategori.show', $k->id) }}" class="tombol">Detail</a>
                         <a href="{{ route('admin.kategori.edit', $k->id) }}" class="tombol">
                                    <i class="fas fa-edit"></i>
                        @csrf
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
            <a href="{{ route('admin.kategori.create') }}" class="submit-btn mb-5" style="color:blue">Tambah Kategori</a>
        </tbody>
    </table>
</div>

@endsection