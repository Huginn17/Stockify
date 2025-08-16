@extends('admin.layout.main')
@section('contentadmin')
<link rel="stylesheet" href="style.css">
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Kategori
                </th>
                <th scope="col" class="px-6 py-3">
                    Alamat
                </th>
                <th scope="col" class="px-6 py-3">
                    No.Telp
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allsupplier as $key => $s) 
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $key + 1 }}
                </th>
                <td class="px-6 py-4">
                    {{ $s->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $s->address }}
                </td>
                <td class="px-6 py-4">
                    {{ $s->phone }}
                </td>
                <td class="px-6 py-4">
                    {{ $s->email }}
                </td>
                <td class="px-6 py-4">
                     <form action="{{ route('admin.supplier.destroy', $s->id) }}" method="POST">
                        <a href="{{ route('admin.supplier.show', $s->id) }}" class="tombol">Detail</a>
                       <a href="{{ route('admin.supplier.edit', $s->id) }}" class="tombol">
                                    <i class="fas fa-edit"></i>
                                  
                        
                <form action="{{ route('admin.supplier.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
<br>
 <a href="{{ route('admin.supplier.create') }}" class="btn" style="margin-left: 83%; font-weight: bold;" >Tambah Supplier + </a>
@endsection