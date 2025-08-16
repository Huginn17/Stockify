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
        <link rel="stylesheet" href="style.css">
        <link rel="icon" sizes="512x512" type="image/png" href="{{ asset('Stockify_orange.png') }}">

        <title>Stockify Admin</title>
    </head>  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


    <body style="background-color: orange">

        <div class="p-4 sm:ml-64">
            <aside id="sidebar-multi-level-sidebar"
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform sm:rounded translate-x-full sm:translate-x-0"
                aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900  dark:bg-gray-800 dark:text-white">

                    <h1 class="text-orange-500">
                        {{ $setting['apk_name'] ?? 'Stockify' }}</h1>
                    <hr style="border: none; height: 1px; background-color: rgb(68, 68, 68)">
                    <ul class="space-y-2 font-bold">
                        <li class="{{ request()->is('admin/dashboard') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a id="mylink" href="{{ route('admin.dashboard') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group  transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                </svg>
                                <span class="ms-3" style="color: white">Dashboard</span>

                            </a>
                        </li>

                        <li class="{{ request()->is('admin/produk') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a href="{{ route('admin.produk') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9.98189 4.50602c1.24881-.67469 2.78741-.67469 4.03621 0l3.9638 2.14148c.3634.19632.6862.44109.9612.72273l-6.9288 3.60207L5.20654 7.225c.2403-.22108.51215-.41573.81157-.5775l3.96378-2.14148ZM4.16678 8.84364C4.05757 9.18783 4 9.5493 4 9.91844v4.28296c0 1.3494.7693 2.5963 2.01811 3.2709l3.96378 2.1415c.32051.1732.66011.3019 1.00901.3862v-7.4L4.16678 8.84364ZM13.009 20c.3489-.0843.6886-.213 1.0091-.3862l3.9638-2.1415C19.2307 16.7977 20 15.5508 20 14.2014V9.91844c0-.30001-.038-.59496-.1109-.87967L13.009 12.6155V20Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Produk</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-white bg-orange-500 rounded-full dark:bg-gray-700 dark:text-gray-300">100%
                                    Ori<span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/stock') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a href="{{ route('admin.stock') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Stock</span>

                            </a>
                        </li>
                        <li class="{{ request()->is('admin/supplier') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a href="{{ route('admin.supplier.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Supplier</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/pengguna') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a href="{{ route('admin.pengguna.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Pengguna</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/laporan/masuk') ? 'bg-orange-600' : '' }} sm:rounded">
                            <a href="{{ route('admin.laporan.masuk') }}"
                                class="flex items-center p-2 text-gray-900 rounded dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Laporan</span>
                            </a>
                        </li>

                        <hr
                            style="border: none; height: 1px; background-color: rgb(68, 68, 68); position: relative; top: 120px;">
                        <li>
                            @include('admin.logout')
                        </li>

                        <li class="{{ request()->is('admin/pengaturan') ? 'bg-orange-600' : '' }} sm:rounded"
                            style="position: relative; top: 140px;">
                            <a href="{{ route('admin.pengaturan') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-orange-600 dark:hover:bg-gray-700 group transition duration-300"
                                style="text-decoration: none">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap" style="color: white">Pengaturan</span>
                            </a>
                        </li>

            </aside>
            @yield('contentadmin')

    </body>

    </html>
