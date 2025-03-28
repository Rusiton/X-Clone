@props(['post', 'search_chars' => '', 'user' => false])

@php
    $userOwnsThis = $user ? ($user->id === $post->profile->user->id ? true : false) : false;
@endphp

<div class="w-full px-4 py-2 flex hover:bg-color-5 transition" 
    wire:key="{{ $post->id }}"
    x-data="{ user: '{{ $user ? true : false }}' }">

    <div class="flex flex-col">
        <a class="flex-1" href="{{ route('profile', ['name' => $post->profile->user->name]) }}">
            @if ($post->profile->picture)
                <img class="h-12 rounded-full" src="{{ Storage::url($post->profile->picture->url) }}">
            @else
                <i class="fa-solid fa-circle-user fa-3x text-color-7"></i>
            @endif
        </a>
    </div>

    <div class="pl-2 flex-1">
        <div class="flex relative">

            <a href="{{ route('profile', ['name' => $post->profile->user->name]) }}" class="flex gap-1">
                <h2 class="text-color-7">
                    {{ strlen($post->profile->username) >= 15 ? substr($post->profile->username, 0, 15) . '...' : $post->profile->username }}
                </h2>

                <span class="text-sm text-color-4">
                    {{ strlen($post->profile->user->name) >= 12 ? '@' . substr($post->profile->user->name, 0, 12) . '...' : '@' . $post->profile->user->name }}
                </span>
            </a>

            <div class="flex items-center gap-2 absolute right-0 top-0">

                <span class="text-xs text-color-4">
                    {{ $post->created_at->diffForHumans(null, true, true) }}
                </span>

                @if ($user)
                    <x-element-options 
                        :element="$post" 
                        type="Post" 
                        :userOwnsThis="$userOwnsThis" 
                    />
                @endif

            </div>

        </div>

        <div>

            <a href="{{ route('post', ['id' => $post->id]) }}">
                <p class="text-color-7 text-[14px] leading-[18px]">
                    {!! str_replace($search_chars, "<span class='font-bold'>$search_chars</span>", $post->text) !!}
                </p>
            </a>

            @if ($post->picture)
                <img class="mt-2 border border-color-3 w-full rounded-xl" src="{{ Storage::url($post->picture->url) }}">
            @endif

            @if ($post->tags)
                <div class="w-full pt-2 flex flex-wrap gap-x-2">
                    @foreach ($post->tags as $tag)
                        <x-post-tag :tag="$tag" class="text-sm" />
                    @endforeach
                </div>
            @endif

        </div>

        <ul class="w-full mt-2 flex gap-6 font-bold select-none">

            <li class="cursor-pointer {{ $user && $this->like->userHasLike($post, $user) ? 'text-color-6' : 'text-color-7' }}">
                <i class="fa-solid fa-heart fa-lg"
                    x-on:click="user && toggleLike(event.target), $wire.liked({{ $post->id }})"></i>
                <span>{{ count($post->likes) }}</span>
            </li>

            <li class="text-color-7 hover:text-color-2">
                <a href="{{ route('post', ['id' => $post->id]) }}">
                    <i class="fa-solid fa-comment fa-lg"></i>
                    <span>{{ count($post->comments) }}</span>
                </a>
            </li>

            <li class="cursor-pointer {{ $user && $this->repost->userHasRepost($post, $user) ? 'text-color-2' : 'text-color-7' }}">
                <i class="fa-solid fa-retweet fa-lg"
                    x-on:click="user && toggleRepost(event.target), $wire.reposted({{ $post->id }})"></i>
                <span>{{ count($post->reposts) }}</span>
            </li>

        </ul>
    </div>
</div>
