<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="style.css">
    <link rel="icon" sizes="512x512" type="image/png" href="{{ asset('Stockify_orange.png') }}">

    <title>Stockify</title>
</head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<body>

    <section class="bg-orange-600">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            </a>
            <div
                class="w-full bg-gray-800 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-50 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 style="color: Orange">Stockify</h1>
                    <p class="text-center" style="position: relative; top: 20px">🔒</p>
                    <h3 style="color: white">Log In</h3>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="space-y-4 md:space-y-6" action="{{ route('loginproses') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-white dark:text-black-900">
                                Email :</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-0 border border-gray-300 shadow hover:bg-gray-100 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-white dark:text-black-900">Password :</label>
                            <input type="password" name="password" id="password" placeholder=""
                                class="bg-gray-0 border border-gray-300 shadow hover:bg-gray-100 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                {{-- <div class="flex items-center h-5">
                                   <input type="checkbox" id="remember" name="remember" 
                                     class="accent-orange-500 hover:accent-orange-600 focus:accent-orange-600 cursor-pointer">
                                </div> --}}
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-white dark:text-black-900">
                                        <input type="checkbox" name="remember" id="remember">
                                        Ingatkan Saya
                                    </label>
                                </div>
                            </div>
                            {{-- <a href="#"
                                class="text-sm font-medium text-primary-600 hover:underline white:text-primary-500">Lupa
                                Password?</a> --}}
                        </div>
                        <button type="submit" class="w-full btn-stockify transition-colors duration-300">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
