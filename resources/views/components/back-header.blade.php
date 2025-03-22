@props(['route', 'title'])

<div class="w-full p-4 border-b-2 border-color-5 bg-color-1">
    <a href="{{ Route::has($route) ? route($route) : route('home') }}" class="flex items-center gap-4">
        <i class="fa-solid fa-arrow-left fa-lg"></i>
        <h1 class="text-xl font-bold">{{ $title }}</h1>
    </a>
</div>