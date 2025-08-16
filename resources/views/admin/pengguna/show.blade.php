@extends('admin.layout.main')
@section('contentadmin')

    <div class="bg-gray-800 sm:rounded-lg shadow p-6 w-full max-w-3xl mx-auto">
        <h3 class="text-white font-semibold mb-6">Detail Pengguna </h3>
        <br>
        <div class="mb-4">
            <div class="bg-gray-50 rounded-md p-3 flex justify-between items-center shadow transition duration-300 hover:bg-gray-200">
                <span class="font-medium">Nama :</span>
                <span>{{ $user->name }}</span>
            </div>
        </div>

        <div class="mb-4">
            <div class="bg-gray-50 rounded-md p-3 flex justify-between items-center shadow transition duration-300 hover:bg-gray-200">
                <span class="font-medium">Role :</span>
                <span>{{ $user->role }}</span>
            </div>
        </div>

        <div class="mb-6">
            <div class="bg-gray-50 rounded-md p-3 flex justify-between items-center shadow transition duration-300 hover:bg-gray-200">
                <span class="font-medium">Email :</span>
                <span>{{ $user->email }}</span>
            </div>
        </div>

      <form action="{{ route('admin.pengguna.index') }}" method="GET"><br>
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
            Kembali
        </button>
    </form>
    </div>
@endsection
