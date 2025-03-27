@props(['profile'])

@php
    $user = Auth::user()
@endphp

<div class="flex-1 flex flex-col overflow-scroll">
    <div class="relative mb-12">
        <img 
            src="https://img.freepik.com/premium-photo/family-enjoying-beach-against-sky-during-sunset_1048944-29945983.jpg?size=338&ext=jpg"
            class="w-full h-52 border-b border-color-3 object-cover"
        >

        @if ($profile->picture)
            <img 
                src="{{ Storage::url($profile->picture->url) }}"
                class="w-24 h-24 border-2 border-color-1 rounded-full absolute left-4 -bottom-12"
            >
        @else
            <i class="fa-solid fa-circle-user fa-6x border-2 border-color-1 rounded-full bg-color-1 absolute left-4 -bottom-12"></i>
        @endif
    </div>

    <div class="p-4 flex">
        <div class="flex-1 overflow-hidden">
            <h2 class="text-[20px] whitespace-nowrap font-extrabold">
                {{ strlen($profile->username) > 20 ? substr($profile->username, 0, 20) . '...' : $profile->username }}
            </h2>
            <span class="text-lg text-color-4 font-light">
                {{ '@' . (strlen($profile->user->name) > 20 ? substr($profile->user->name, 0, 20) . '...' : $profile->user->name) }}
            </span>
        </div>

        @livewire('follow-button', ['profile' => $profile, 'user' => $user])
    </div>

    <div class="px-4">
        <p>
            {{ $profile->biography }}
        </p>
    </div>

    <div class="p-4 flex gap-6 text-[17px]">
        <h3 class="font-bold">{{ count($profile->followers) }} <span class="ml-1 font-light">Followers</span></h3>
        <h3 class="font-bold">{{ count($profile->user->following) }} <span class="ml-1 font-light">Following</span></h3>
        <h3 class="font-bold">{{ count($profile->posts) }} <span class="ml-1 font-light">Posts</span></h3>
    </div>

    @livewire('profile-elements', ['profile' => $profile, 'user' => $user])
</div>