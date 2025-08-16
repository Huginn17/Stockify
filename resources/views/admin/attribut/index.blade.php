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
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Attribut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Value
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allattribut as $key => $a)
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $a->produk->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $a->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $a->value }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.attribut.destroy', $a->id) }}" method="POST">
                                <a href="{{ route('admin.attribut.show', $a->id) }}" class="tombol">Detail</a>
                                
                                <a href="{{ route('admin.attribut.edit', $a->id) }}" class="tombol">
                                    <i class="fas fa-edit"></i>
                                </a>

                               <form action="{{ route('admin.attribut.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
    <a href="{{ route('admin.attribut.create') }}" class="">Tambahkan Attribut</a>
@endsection
