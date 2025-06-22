<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('SlashTech .ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Left: Login Form -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center ">
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl rounded-2xl">
                <div class="text-center mb-6">
                    <a href="/" class="inline-block mb-3">
                        <x-application-logo class="mx-auto" style="max-width: 32px;" />
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>

        <!-- Right: Image -->
        <div class="hidden md:block w-[70%]">
            <img src="{{ asset('storage/images/Logo_Mockup.jpg') }}" alt="صورة جانبية"
                class="w-full h-screen object-cover">
        </div>

    </div>
</body>

</html>
