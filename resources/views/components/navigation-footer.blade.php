@php
    $user = Auth::user();
@endphp

<div class="w-full h-20 px-4 bg-color-1 border-t-2 border-color-5 absolute bottom-0 z-10 flex justify-between items-center">

    <a href="{{ route('home') }}" class="w-12 h-full flex justify-center items-center {{ Route::is('home') ? 'border-b-4 border-color-2' : '' }}">
        <i class="fa-solid fa-house fa-2xl"></i>
    </a>

    <a href="{{ route('search') }}" class="w-12 h-full flex justify-center items-center {{ Route::is('search') ? 'border-b-4 border-color-2' : '' }}">
        <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
    </a>

    @if ($user)
        @if ($user->profile->picture)
            <a href="{{ $user ? route('profile', ['user' => $user->id]) : route('login') }}" 
                class="w-12 h-full flex justify-center items-center {{ Route::is('profile') ? 'border-b-4 border-color-2' : '' }}">
                <img class="w-full rounded-full" src="{{ Storage::url($user->profile->picture->url) }}">
            </a>
        @else
            <a href="{{ $user ? route('profile', ['user' => $user->id]) : route('login') }}" 
                class="w-12 h-full flex justify-center items-center {{ Route::is('profile') ? 'border-b-4 border-color-2' : '' }}">
                <i class="fa-solid fa-circle-user fa-2xl"></i>
            </a>
        @endif
    @else
        <a href="{{ route('login') }}" 
            class="w-12 h-full flex justify-center items-center {{ Route::is('profile') ? 'border-b-4 border-color-2' : '' }}">
            <i class="fa-solid fa-circle-user fa-2xl"></i>
        </a>
    @endif

</div>