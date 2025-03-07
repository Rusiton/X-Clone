@props(['comment'])

<div class="w-full px-4 py-3 border-b-2 border-color-5 flex">
    <div>
        <a href="{{ route('profile', ['user' => $comment->user->name]) }}">
            @if ($comment->user->profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($comment->user->profile->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-3x"></i>
            @endif
        </a>
    </div>

    <div class="pl-2 flex-1">
        <div class="flex relative" x-data="{ open: false }">
            <a href="{{ route('profile', ['user' => $comment->user->name]) }}" class="flex gap-1">
                <h2>
                    {{ strlen($comment->user->profile->username) >= 18 ? substr($comment->user->profile->username, 0, 18) . '...' : $comment->user->profile->username }}
                </h2>

                <span class="text-sm text-color-4">
                    {{ strlen($comment->user->name) >= 18 ? '@' . substr($comment->user->name, 0, 18) . '...' : '@' . $comment->user->name }}
                </span>
            </a>
        </div>

        <div>
            <p class="text-[14px] leading-[18px]">
                {{ $comment->text }}
            </p>
        </div>
    </div>
</div>