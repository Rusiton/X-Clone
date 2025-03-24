@props(['comment', 'user' => false])

<div class="w-full px-4 py-3 border-b-2 border-color-5 flex" x-data="{ open: false }">
    <div>
        <a href="{{ route('profile', ['name' => $comment->user->name]) }}">
            @if ($comment->user->profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($comment->user->profile->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-3x"></i>
            @endif
        </a>
    </div>

    <div class="pl-2 flex-1">
        <div class="flex relative">
            <a href="{{ route('profile', ['name' => $comment->user->name]) }}" class="flex gap-1">
                <h2>
                    {{ strlen($comment->user->profile->username) >= 18 ? substr($comment->user->profile->username, 0, 18) . '...' : $comment->user->profile->username }}
                </h2>

                <span class="text-sm text-color-4">
                    {{ strlen($comment->user->name) >= 18 ? '@' . substr($comment->user->name, 0, 18) . '...' : '@' . $comment->user->name }}
                </span>
            </a>

            @if ($user)
                
                <div class="flex items-center gap-2 absolute right-0 top-0">
                    <span class="text-xs">
                        {{ $comment->created_at->diffForHumans(null, true, true) }}
                    </span>
                    <span class="cursor-pointer" x-on:click="open = !open">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                </div>

                <div class="shadow-lg bg-color-1 hover:bg-color-5 absolute right-4 top-0 z-10"
                    x-show="open"
                    x-on:click.outside="open = false">
                    <button class="px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                        wire:click="openReportModal({{ $comment->id }}, 'Comment')"
                        wire:loading.remove
                        wire:target="openReportModal">
                        Report
                    </button>

                    <button class="px-4 py-2 bg-color-5"
                        wire:loading
                        wire:target="openReportModal">
                        <i class="fa-solid fa-circle-notch fa-spin"></i>
                    </button>
                </div>

            @endif

        </div>

        <div>
            <p class="text-[14px] leading-[18px]">
                {{ $comment->text }}
            </p>
        </div>
    </div>
</div>