@extends('admin.layout.main')

@section('contentadmin')
    <div class="p-4 sm:ml-60">

        
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-4H5l7-7 7 7h-4v4H9z" />
            </svg>
            Detail Aktivitas ⓘ
        </h3>

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">
            <div class="divide-y divide-gray-200">

                <div class="px-6 py-3 bg-gray-50 flex justify-between">
                    <span class="font-semibold text-gray-600">📅 Tanggal :</span>
                    <span class="text-gray-800">{{ $log->created_at->format('d M Y H:i') }}</span>
                </div>

                <div class="px-6 py-3 bg-white flex justify-between">
                    <span class="font-semibold text-gray-600">👤 Pengguna :</span>
                    <span class="text-gray-800">{{ $log->user->name ?? 'System' }}</span>
                </div>

                <div class="px-6 py-3 bg-gray-50 flex justify-between">
                    <span class="font-semibold text-gray-600">⚡ Aksi :</span>
                    <span class="text-gray-800">{{ $log->action }}</span>
                </div>

                <div class="px-6 py-3 bg-white">
                    <span class="font-semibold text-gray-600 block">📝 Deskripsi :</span>
                    <p class="text-gray-800 mt-1">{{ $log->description }}</p>
                </div>

                <div class="px-6 py-3 bg-gray-50 flex justify-between">
                    <span class="font-semibold text-gray-600">📂 Modul :</span>
                    <span class="text-gray-800">{{ $log->module }}</span>
                </div>

                <div class="px-6 py-3 bg-white flex justify-between">
                    <span class="font-semibold text-gray-600">🌐 IP Address :</span>
                    <span class="text-gray-800">{{ $log->ip }}</span>
                </div>

            </div>
        </div>

       
        <div class="mt-6">
              <form action="{{ route('admin.lapaktivitas') }}" method="GET"><br>
        <button type="submit" style="border-radius: 20vh"
            class="bg-orange-500 text-white hover:bg-orange-700 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
            Kembali
        </button>
        </div>
    </div>
@endsection
