@extends('admin.layout.main')
@section('contentadmin')

<div class="max-w-3xl mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-lg border-gray-200">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-white flex items-center gap-2">
            {{-- <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 3v2.25m4.5-2.25v2.25M4.5 7.5h15M5.25 21h13.5a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H5.25A1.5 1.5 0 003.75 7.5v12a1.5 1.5 0 001.5 1.5z"/>
            </svg> --}}
            Detail Kategori ⓘ
        </h3>
       
    </div>

    <div class="space-y-4 text-gray-800 text-lg">
        <div class="flex justify-between bg-gray-50 p-3 hover:bg-gray-200 transition duration-300 sm:rounded-lg shadow">
            <span class="font-semibold">Nama Kategori :</span>
            <span>{{ $kategori->name }}</span>
        </div>
        <div class="flex justify-between bg-gray-50 p-3 hover:bg-gray-200 transition duration-300 sm:rounded-lg shadow">
            <span class="font-semibold">Deskripsi :</span>
            <span>{{ $kategori->description ?? '-' }}</span>
        </div>
    </div>
    <br>
    <form action="{{ route('admin.kategori.index') }}" method="GET"><br>
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
            Kembali
        </button>
    </form>
    
</div>

@endsection
