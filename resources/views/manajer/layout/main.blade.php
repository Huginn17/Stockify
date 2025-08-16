@php
    $setting = \App\Models\Setting::pluck('value', 'key');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" sizes="512x512" type="image/png" href="{{ asset('Stockify_orange.png') }}">

    <title>Stockify Manager</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<body style="background-color: orange">

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 dark:bg-gray-800">
            <h1 class="text-orange-500 mb-4 text-4xl font-semibold font-sans">
                {{ $setting['apk_name'] ?? 'Stockify' }}
            </h1>
            <hr style="border: none; height: 1px; background-color: rgb(68, 68, 68)">
            <ul class="space-y-2 font-medium mt-4">
                <li class="{{ request()->is('manajer/dashboard') ? 'bg-orange-600' : '' }} sm:rounded">
                    <a href="{{ route('manajer.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                        style="text-decoration: none">
                        <svg class="w-5 h-5 text-gray-50 transition duration-75 dark:text-gray-400  dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-4" style="color: white">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('manajer/produk') ? 'bg-orange-600' : '' }} sm:rounded">
                    <a href="{{ route('manajer.produk') }}"
                        class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                        style="text-decoration: none">
                        <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9.98189 4.50602c1.24881-.67469 2.78741-.67469 4.03621 0l3.9638 2.14148c.3634.19632.6862.44109.9612.72273l-6.9288 3.60207L5.20654 7.225c.2403-.22108.51215-.41573.81157-.5775l3.96378-2.14148ZM4.16678 8.84364C4.05757 9.18783 4 9.5493 4 9.91844v4.28296c0 1.3494.7693 2.5963 2.01811 3.2709l3.96378 2.1415c.32051.1732.66011.3019 1.00901.3862v-7.4L4.16678 8.84364ZM13.009 20c.3489-.0843.6886-.213 1.0091-.3862l3.9638-2.1415C19.2307 16.7977 20 15.5508 20 14.2014V9.91844c0-.30001-.038-.59496-.1109-.87967L13.009 12.6155V20Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Produk</span>

                    </a>
                </li>
                <li class="{{ request()->is('manajer/stock') ? 'bg-orange-600' : '' }} sm:rounded">
                    <a href="{{ route('manajer.stock') }}"
                        class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                        style="text-decoration: none">
                        <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Stock</span>

                    </a>
                </li>
                <li class="{{ request()->is('manajer/supplier') ? 'bg-orange-600' : '' }} sm:rounded">
                    <a href="{{ route('manajer.supplier') }}"
                        class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                        style="text-decoration: none">
                        <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Supplier</span>
                    </a>
                </li>


                <li class="{{ request()->is('manajer/laporan/masuk') ? 'bg-orange-600' : '' }} sm:rounded">
                    <a href="{{ route('manajer.laporan.masuk') }}"
                        class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                        style="text-decoration: none">
                        <svg class="w-6 h-6 text-gray-50 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Laporan</span>
                    </a>
                </li>
                <hr
                    style="border: none; height: 1px; background-color: rgb(68, 68, 68); position: relative; top: 220px;">
                <li style="position: relative; top: 100px;">
                    @include('manajer.logout')
                </li>
        </div>
    </aside>
    @yield('contentmanajer')
</body>

</html>
