<div class="w-full px-4 py-2 border-b-2 border-color-5 flex">
    <div>
        <a href="{{ route('profile', ['user' => $post->profile->user->name]) }}">
            @if ($post->profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($post->profile->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-3x"></i>
            @endif
        </a>
    </div>

    <div class="pl-2 flex-1">
        <div class="flex relative" x-data="{ open: false }">
            <a href="{{ route('profile', ['user' => $post->profile->user->name]) }}" class="flex gap-1">
                <h2>
                    {{ strlen($post->profile->username) >= 15 ? substr($post->profile->username, 0, 15) . '...' : $post->profile->username }}
                </h2>

                <span class="text-sm text-color-4">
                    {{ strlen($post->profile->user->name) >= 12 ? '@' . substr($post->profile->user->name, 0, 12) . '...' : '@' . $post->profile->user->name }}
                </span>
            </a>

            <div class="flex items-center gap-2 absolute right-0 top-0">
                <span class="text-xs">
                    {{ $post->created_at->diffForHumans(null, true, true) }}
                </span>
                <span class="cursor-pointer" x-on:click="open = !open">
                    <i class="fa-solid fa-ellipsis"></i>
                </span>
            </div>

            <div class="shadow-lg bg-color-1 hover:bg-color-5 absolute right-4 top-0 z-10"
                x-show="open"
                x-on:click.outside="open = false">
                <button class="px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                    wire:click="openReportModal({{ $post->id }}, 'Post')"
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
        </div>

        <div>
            <a href="{{ route('post', ['id' => $post->id]) }}">
                <p class="text-[14px] leading-[18px]">
                    {{ $post->text }}
                </p>
            </a>

            @if ($post->picture)
                <img class="mt-2 w-full rounded-xl" src="{{ Storage::url($post->picture->url) }}">
            @endif
        </div>

        <ul class="w-full mt-2 flex gap-6 font-bold select-none">
            <li class="cursor-pointer {{ $this->userHasLike($post) ? 'text-color-6' : 'text-black' }}"
                x-on:click="user && toggleLike($el), $wire.liked({{ $post->id }})">
                <i class="fa-solid fa-heart fa-lg"></i>
                <span>{{ count($post->likes) }}</span>
            </li>
            <li class="hover:text-color-2">
                <a href="{{ route('post', ['id' => $post->id]) }}">
                    <i class="fa-solid fa-comment fa-lg"></i>
                    <span>{{ count($post->comments) }}</span>
                </a>
            </li>
            <li class="cursor-pointer {{ $this->userHasRepost($post) ? 'text-color-2' : '' }}"
                x-on:click="user && toggleRepost($el), $wire.reposted({{ $post->id }})">
                <i class="fa-solid fa-retweet fa-lg"></i>
                <span>{{ count($post->reposts) }}</span>
            </li>
        </ul>
    </div>
</div>