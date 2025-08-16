@extends('admin.layout.main')

@section('contentadmin')
    <div class="sm:ml-60">
        <div class="bg-gray-800 p-6 sm:rounded-lg shadow-lg mb-4 flex items-center gap-4">
            <div class="mr-auto">
                <h2 class="text-xl font-bold text-white">Laporan Aktivitas 📝</h2>
            </div>
            <div>
                <form method="GET" action="" >
                    <input type="text" name="search" placeholder="🔍︎  Cari aksi atau modul..."
                        value="{{ request('search') }}"
                        class="w-[300px] px-3 py-2 border bg-gray-0 hover:bg-gray-100 transition duration-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
                </form>
            </div>
        </div>

        <div class="relative flex overflow-x-auto shadow-sm sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-blue-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Pengguna</th>
                        <th class="px-6 py-3">Aksi</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3">Modul</th>
                        <th class="px-6 py-3">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($log as $l)
                        <tr
                            class="odd:bg-white hover:bg-gray-100 odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200">
                            <td class="px-6 py-3">{{ $l->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-3">{{ $l->user->name ?? 'System' }}</td>
                            <td class="px-6 py-3">
                                @php
                                    $color = match (strtolower($l->action)) {
                                        'tambah', 'create' => 'bg-green-100 text-green-800',
                                        'update', 'ubah' => 'bg-yellow-100 text-yellow-800',
                                        'hapus', 'delete' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">
                                    {{ $l->action }}
                                </span>
                            </td>
                            <td class="px-6 py-3">{{ $l->description }}</td>
                            <td class="px-6 py-3">{{ $l->module }}</td>
                            <td class="px-6 py-3">
                                @if (!empty($l->meta))
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <a href="{{ route('admin.aktivitas.detail', $l->id) }}" class="inline-block">
                                            <button type="button" style="border-radius: 20vh"
                                                class="bg-orange-500 hover:bg-orange-600 transition duration-300 text-white font-semibold py-1 px-3 flex items-center shadow gap-1">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </a>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada aktivitas ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-gray-800 mt-10">
            {{ $log->links() }}
        </div>

        <form action="{{ route('admin.laporan.masuk') }}" method="GET" class="mt-4">
            <button type="submit" style="border-radius: 20vh"
                class="bg-gray-800 text-white hover:bg-gray-700 hover:text-white font-bold py-2 px-4 rounded-full shadow-lg -white transition duration-300">
                Kembali
            </button>
        </form>
    </div>
@endsection
