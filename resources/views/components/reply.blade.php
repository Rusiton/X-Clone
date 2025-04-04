@props(['reply', 'user' => false])

@php
    $userOwnsThis = $user ? ($user->id === $reply->user->id ? true : false) : false
@endphp

<div class="w-full px-4 py-2 border-b-2 border-color-5 flex relative">
    <a href="{{ route('post', ['id' => $reply->post->id]) }}" class="flex-1 flex">
        <div>
            @if ($reply->user->profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($reply->user->profile->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-3x text-color-7"></i>
            @endif
        </div>

        <div class="flex-1 pl-2 flex flex-wrap">
            <h2 class="text-color-7">
                {{ strlen($reply->user->profile->username) >= 15 ? substr($reply->user->profile->username, 0, 15) . '...' : $reply->user->profile->username }}
            </h2>

            <span class="pl-1 text-sm text-color-4">
                {{ strlen($reply->user->name) >= 12 ? '@' . substr($reply->user->name, 0, 12) . '...' : '@' . $reply->user->name }}
            </span>

            <p class="w-full text-color-7 text-[14px] leading-[18px]">
                {{ $reply->text }}
            </p>
        </div>
    </a>

    <div class="flex items-center gap-2 absolute top-2 right-4">
        <span class="pb-[2px] text-color-7 text-xs">
            {{ $reply->created_at->diffForHumans(null, true, true) }}
        </span>

        @if ($user)
            <x-element-options
                :element="$reply"
                type="Comment"
                :userOwnsThis="$userOwnsThis"
            />
        @endif

    </div>
</div>