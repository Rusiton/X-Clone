<div x-data="{ user: '{{ $user ? true : false }}' }" class="pb-20 overflow-y-scroll">
    
    <x-report-modal :post="$report_post" :already_reported="$already_reported" />

    <div class="w-full p-4 border-b-2 border-color-5 flex flex-wrap">
    
        <div class="w-full flex">
            <div class="flex">
                <a href="{{ route('profile', ['user' => $post->profile->user->name]) }}">
                    @if ($post->profile->picture)
                        <img class="h-12 rounded-full" src="{{ Storage::url($post->profile->picture->url) }}">    
                    @else
                        <i class="fa-solid fa-circle-user fa-3x"></i>
                    @endif
                </a>
            </div>
    
            <div class="flex-1 flex items-center relative" x-data="{ open: false }">
                <a href="{{ route('profile', ['user' => $post->profile->user->name]) }}" class="flex-1 pl-2 leading-4">
                    <h2 class="font-semibold">
                        {{ strlen($post->profile->username) >= 24 ? substr($post->profile->username, 0, 24) . '...' : $post->profile->username }}
                    </h2>
    
                    <span class="text-sm text-color-4">
                        {{ strlen($post->profile->user->name) >= 24 ? '@' . substr($post->profile->user->name, 0, 24) . '...' : '@' . $post->profile->user->name }}
                    </span>
                </a>
    
                <div class="flex items-center gap-2">
                    <span class="cursor-pointer" x-on:click="open = !open">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                </div>

                <div class="shadow-lg bg-color-1 hover:bg-color-5 absolute right-4 top-0 z-10"
                    x-show="open"
                    x-on:click.outside="open = false">
                    <button class="px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                        wire:click="openReportModal({{ $post }})"
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
        </div>

        <div class="w-full pt-4">
            <p class="text-[14px] leading-[18px]">
                {{ $post->text }}
            </p>

            @if ($post->picture)
                <img class="mt-2 w-full rounded-xl" src="{{ Storage::url($post->picture->url) }}">
            @endif
        </div>

        <div>
            <p class="mt-2 text-color-4">
                {{ $post->created_at->format('h:i jS F, Y') }}
            </p>
        </div>

        <ul class="w-full mt-2 flex gap-6 font-bold select-none">
            <li class="cursor-pointer {{ $this->userHasLike($post) ? 'text-color-6' : 'text-black' }}"
                x-on:click="user && toggleLike($el), $wire.liked({{ $post->id }})">
                <i class="fa-solid fa-heart fa-xl"></i>
                <span>{{ count($post->likes) }}</span>
            </li>
            <li class="hover:text-color-2">
                <a href="{{ route('post', ['id' => $post->id]) }}">
                    <i class="fa-solid fa-comment fa-xl"></i>
                    <span>{{ count($post->comments) }}</span>
                </a>
            </li>
            <li class="cursor-pointer {{ $this->userHasRepost($post) ? 'text-color-2' : '' }}"
                x-on:click="user && toggleRepost($el), $wire.reposted({{ $post->id }})">
                <i class="fa-solid fa-retweet fa-xl"></i>
                <span>{{ count($post->reposts) }}</span>
            </li>
        </ul>

    </div>

    <div>
        <div class="p-4 border-b border-color-3 flex">
            @if ($user)
                <div>
                    @if ($user->picture)
                        <img src="{{ Storage::url($user->picture->url) }}">    
                    @else
                        <i class="fa-solid fa-circle-user fa-3x"></i>
                    @endif
                </div>
                
                <div class="flex-1 pl-2" x-data="{ comment: '' }">
                    <x-textarea 
                        class="w-full h-24 bg-color-5 resize-none"
                        placeholder="Add a comment..." 
                        wire:model="comment"
                        x-model="comment"
                    />

                    <div class="flex">
                        <div class="flex-1 pr-2">
                            <x-input-error for="comment"/>
                        </div>

                        <button 
                            class="px-4 py-1 border border-color-3 rounded-full bg-color-2 transition text-color-1 font-semibold float-right disabled:opacity-50"
                            wire:click="addComment()"
                            x-bind:disabled="comment.length > 0 ? false : true">
                            POST
                        </button>
                    </div>
                </div>
            @endif
        </div>

        @foreach ($post->comments->reverse() as $comment)
            <x-comment :comment="$comment" />
        @endforeach
    </div>

</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('storage/js/posts/postInteractionControl.js') }}"></script>
@endpush
