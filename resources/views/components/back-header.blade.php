@props(['title'])

<div class="w-full p-4 border-b-2 border-color-5 bg-color-1">
    <a href="{{ session()->get('previous-url', 'home') }}" class="flex items-center gap-4">
        <i class="fa-solid fa-arrow-left fa-lg text-color-7"></i>
        <h1 class="text-color-7 text-xl font-bold">{{ $title }}</h1>
    </a>
</div>