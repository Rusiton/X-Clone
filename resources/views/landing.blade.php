<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>X-Clone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="w-screen h-screen">
    <div class="relative w-full h-full px-4 font-poppins">
        <h1 class="pt-9 text-5xl font-bold">X-Clone</h1>

        <p class="mt-10 text-3xl/9 font-bold">Share posts, follow others and stay connected with everyone.</p>

        <p class="mt-10 text-3xl/9 font-bold">Join Today</p>

        <div class="mt-10 w-full flex flex-col items-center gap-4">
            <a href="{{ route('login') }}" class="w-3/4 max-w-xl py-3 border-2 rounded-full border-color-3 bg-color-1 flex justify-center items-center font-semibold text-color-2">Log In</a>
            
            <a href="{{ route('register') }}" class="w-3/4 max-w-xl py-3 border-2 rounded-full bg-color-2 flex justify-center items-center font-semibold text-color-1">Register</a>

            <div class="w-3/4 flex items-center">
                <hr class="flex-1 bg-color-3">
                <span class="mx-2 font-semibold">or</span>
                <hr class="flex-1 bg-color-3">
            </div>

            <a href="{{ route('home') }}" class="w-3/4 max-w-xl py-3 border-2 rounded-full border-color-3 bg-color-1 flex justify-center items-center font-light text-color-4">Continue as a Guest</a>
        </div>

        <div class="w-full absolute left-0 bottom-0 px-4 text-center font-light">
            <p>This is a non-profit application, designed just for fun and to test someone's developement skills.</p>

            <p class="mt-3">Designed & developed by Santiago Galasso</p>
        </div>
    </div>
</body>
</html>