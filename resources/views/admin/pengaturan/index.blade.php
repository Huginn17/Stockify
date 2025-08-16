@extends('admin.layout.main')
@section('contentadmin')
    <div class="p-4 sm:ml-60">
        <div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">

            <h2 class="text-2xl font-bold text-center text-white mb-6">Pengaturan Umum</h2>
            <hr border="1" class="text-gray-100">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-sm text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

            
                <div class="mb-5">
                    <label for="apk_name" class="block text-sm font-semibold text-orange-500 mb-1">Nama Aplikasi</label>
                    <input type="text" name="apk_name" id="apk_name" value="{{ $setting['apk_name'] ?? '' }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

            
                <div class="mb-5">
                    <label for="apk_logo" class="block text-sm font-semibold text-orange-500 mb-1">Logo Aplikasi</label>

                    @if (!empty($setting['apk_logo']))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $setting['apk_logo']) }}" alt="Logo Aplikasi"
                                class="h-20 object-contain">
                        </div>
                    @endif
                    <br>
                    <input type="file" name="apk_logo" id="apk_logo"
                        class="block w-full text-sm text-white border border-white rounded cursor-pointer file:bg-orange-500 file:text-white file:px-4 file:py-2 file:mr-4 file:border-0 file:rounded hover:file:bg-orange-400 transition">
                </div>

                
                <div class="text-center">
                    <button type="submit" style="border-radius: 20vh"
                        class="bg-orange-500 hover:bg-orange-400 text-white w-full font-semibold px-6 py-2 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
