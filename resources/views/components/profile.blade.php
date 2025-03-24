@props([
    'profile', 
    'search_chars' => '',
    'user' => false,
])

<div class="w-full px-4 py-2 border-b-2 border-color-5 flex hover:bg-color-5 transition">
    <div>
        <a href="{{ route('profile', ['name' => $profile->user->name]) }}">
            @if ($profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($profile->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-3x"></i>
            @endif
        </a>
    </div>

    <div class="pl-2 flex-1">
        <div class="flex relative" x-data="{ open: false }">
            <a href="{{ route('profile', ['name' => $profile->user->name]) }}" class="flex gap-1">
                <h2>
                    {!!
                        str_replace(
                            $search_chars,
                            "<span class='font-bold'>$search_chars</span>",
                            strlen($profile->username) > 16 ? substr($profile->username, 0, 16) . '...' : $profile->username
                        )
                    !!}
                </h2>

                <span class="text-sm text-color-4">
                    {{ strlen($profile->user->name) >= 12 ? '@' . substr($profile->user->name, 0, 12) . '...' : '@' . $profile->user->name }}
                </span>
            </a>

            <div class="flex items-center gap-2 absolute right-0 top-0">
                @if ($user)

                    <span class="cursor-pointer" x-on:click="open = !open">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                    
                    <div class="w-28 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
                        x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
                        wire:loading.remove
                        wire:target="openReportModal">

                        @if ($profile->user->id !== $user->id)
                            <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                                wire:click="openReportModal({{ $profile->id }}, 'Profile')"
                                x-on:click="open = false">
                                Report
                            </button>
                        @endif
                    </div>
                    
                @endif
            </div>
        </div>

        <div>
            @if ($profile->biography)
                <a href="{{ route('profile', ['name' => $profile->user->name]) }}">
                    <p class="text-[14px] leading-[18px]">
                        {!!
                            str_replace(
                                $search_chars,
                                "<span class='font-bold'>$search_chars</span>",
                                strlen($profile->biography) > 100 ? substr($profile->biography, 0, 100) . '...' : $profile->biography
                            )
                        !!}
                    </p>
                </a>
            @endif
        </div>
    </div>
</div>