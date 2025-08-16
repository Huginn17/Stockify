@extends('admin.layout.main')
@section('contentadmin')
    @php
        $setting = \App\Models\Setting::pluck('value', 'key');
    @endphp

    <body style="background-color: orange">
        <nav class="text-white p-4 sm:rounded-lg shadow-lg bg-gray-800">
            <div class="flex justify-between items-center">
                
                <h2 class="ml-2 text-orange-400" style="font-size: 19px; font-weight: bold">Admin</h2>
                
                @if (!empty($setting['apk_logo']))
                    <img src="{{ asset('storage/' . $setting['apk_logo']) }}" alt="Logo"
                        class="h-12 rounded-full shadow-md">
                @endif
            </div>
            <hr border="1" color="white" class="mt-3 dark:white">
            <div style="font-size: 28px;" class="ml-2">
                <div style="margin-bottom: 8px;">
                    <p class="text-white mt-2" style="margin-bottom: 4px;">Hallo, Selamat Datang
                        <strong>{{ Auth::user()->name }}</strong>
                    </p>
                    <p style="font-size: 14px; color: rgb(255, 255, 255); margin-top: 0;">Kelola Stok Barang Kamu &
                        Tingkatkan Bisnismu Di Stockify</p>
                </div>
        </nav>



        <div class="relative overflow-hidden mt-5 font-semibold bg-gray-800 text-white rounded-lg shadow-lg p-3 group">
            <div class="overflow-hidden whitespace-nowrap">
                <div class="inline-block"
                    style="animation: marquee-left 35s linear infinite; white-space: nowrap; font-style: italic">
                    📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                    tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                    waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya | &nbsp;
                    📦 Stok selalu ready, bisnis selalu steady | 🏭 Gudang pintar untuk bisnis cerdas | 🚚 Dari rak ke
                    tangan Anda, cepat, rapi, pasti aman, gratis ongkir | ⚡ Solusi stok modern, tanpa ribet, tanpa telat
                    waktu | 💰 Stok aman, bisnis lancar, untung mengalir, 100% terpercaya | &nbsp;
                </div>
            </div>
        </div>

        <style>
            @keyframes marquee-left {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }
        </style>

        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4 flex mt-5 items-end gap-4">
            <div class="flex flex-col">
                <label for="tanggal_mulai" class="mb-2 text-md font-medium">
                    Tanggal Mulai :
                </label>
                <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                    class="border bg-gray-0 shadow-lg transition duration-300 hover:bg-gray-100 p-2 rounded">
            </div>

            <div class="flex flex-col">
                <label for="tanggal_selesai" class="mb-2 text-md font-medium">
                    Tanggal Selesai :
                </label>
                <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                    class="border bg-gray-0 shadow-lg  transition duration-300 hover:bg-gray-100 p-2 rounded">
            </div>

            <div>
                <button type="submit" style="border-radius: 20vh"
                    class="bg-gray-800 text-white font-semibold px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    Filter
                </button>
            </div>
        </form>

        

        <br>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-800 p-4 sm:rounded-lg hover:bg-gray-700 shadow-lg transition duration-300 hover:scale-[1.03]">
                <h3 class="font-semibold text-white">Jumlah Produk </h3>
                <p class="text-2xl font-bold text-blue-600 mt-2">{{ $jumlahProduk }}</p>
            </div>
            <div class="bg-gray-800 p-4 sm:rounded-lg hover:bg-gray-700 shadow-lg transition duration-300 hover:scale-[1.03]">
                <h3 class="font-semibold text-white">Transaksi Masuk </h3>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $jumlahMasuk }}</p>
            </div>
            <div class="bg-gray-800 p-4 sm:rounded-lg hover:bg-gray-700 shadow-lg transition duration-300 hover:scale-[1.03]">
                <h3 class="font-semibold text-white">Transaksi Keluar </h3>
                <p class="text-2xl font-bold text-red-600 mt-2">{{ $jumlahKeluar }}</p>
            </div>
        </div>
        <br>
        <!-- Grafik -->
        <div class="bg-white p-4 sm:rounded-lg border shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Grafik Transaksi Periode </h2>
            <canvas id="transaksiChart" height="100"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('transaksiChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($periode),
                    datasets: [{
                            label: 'Barang Masuk',
                            data: @json($masukPeriode),
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Barang Keluar',
                            data: @json($keluarPeriode),
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script><br>

            {{-- ACT LOG --}}
           <h3 class="text-lg font-extrabold mb-4 mt-5">Aktivitas Pengguna Terbaru :</h3>

<div class="grid gap-5">
    @forelse($log as $l)
        <div class="bg-gray-800 shadow-lg rounded-lg p-4 border-l-4 hover:bg-gray-700 transition duration-300 hover:scale-[1.02]
            @if(Str::contains(strtolower($l->action), 'konfirmasi')) border-teal-500 
            @elseif(Str::contains(strtolower($l->action), 'buat')) border-yellow-500 
            @elseif(Str::contains(strtolower($l->action), 'tambah')) border-green-500
            @elseif(Str::contains(strtolower($l->action), 'ubah')) border-purple-500 
            @elseif(Str::contains(strtolower($l->action), 'hapus')) border-red-500 
            @elseif(Str::contains(strtolower($l->action), 'export')) border-cyan-500 
            @elseif(Str::contains(strtolower($l->action), 'input')) border-orange-500 
            @elseif(Str::contains(strtolower($l->action), 'import')) border-lime-500 
            @elseif(Str::contains(strtolower($l->action), 'login')) border-rose-500 
            @elseif(Str::contains(strtolower($l->action), 'logout')) border-fuchsia-500 
            @else border-gray-400 @endif">

            <p class="font-bold text-orange-500">{{ $l->action }}</p>
            <p class="text-white text-sm">{{ $l->description }}</p>
            <p class="text-xs text-gray-400 mt-1">
                {{ $l->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
            </p>
        </div>
    @empty
        <p class="text-gray-800">Tidak ada aktivitas terbaru</p>
    @endforelse
</div>


        </div>
    </body>
@endsection
