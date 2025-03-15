<div class="pb-20 overflow-y-scroll" x-data="{ user: '{{ $user ? true : false }}' }" x-on:click="handleClick(event.target, user)">
    
    <x-report-modal 
        :reportable="$report->reportable" 
        :reportable_model="$report->reportable_model" 
        :already_reported="$report->already_reported" 
    />

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
    
                @if ($user)
                    <span class="cursor-pointer" x-on:click="open = !open">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>

                    <div class="w-28 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
                        x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
                        wire:loading.remove
                        wire:target="openReportModal">

                        @if ($post->profile->user->id !== $user->id)
                            <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                                wire:click="openReportModal()"
                                x-on:click="open = false">
                                Report
                            </button>
                        @endif
                        
                        @if ($post->profile->user->id === $user->id)
                            <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition text-color-6"
                                x-on:click="open = false, showConfirmButton({{ $post->id }})">
                                Delete
                            </button>    
                        @endif    
                    </div>
                @endif
                
            </div>
        </div>

        <div class="w-full pt-4">
            <p class="text-[14px] leading-[18px]">
                {{ $post->text }}
            </p>

            @if ($post->picture)
                <img class="mt-2 w-full border border-color-3 rounded-xl" src="{{ Storage::url($post->picture->url) }}">
            @endif

            @if ($post->tags)
                <div class="pt-2">
                    @foreach ($post->tags as $tag)
                        <x-post-tag :tag="$tag" />
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <p class="mt-2 text-color-4">
                {{ $post->created_at->format('h:i jS F, Y') }}
            </p>
        </div>

        <ul class="w-full mt-2 flex gap-6 font-bold select-none">
            <li class="cursor-pointer {{ $this->userHasLike() ? 'text-color-6' : 'text-black' }}">
                <i id="like" class="fa-solid fa-heart fa-xl"></i>
                <span>{{ count($post->likes) }}</span>
            </li>
            <li id="comment" class="hover:text-color-2">
                <a href="{{ route('post', ['id' => $post->id]) }}">
                    <i class="fa-solid fa-comment fa-xl"></i>
                    <span>{{ count($post->comments) }}</span>
                </a>
            </li>
            <li class="cursor-pointer {{ $this->userHasRepost() ? 'text-color-2' : '' }}">
                <i id="repost" class="fa-solid fa-retweet fa-xl"></i>
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
                        wire:model.live="comment.comment"
                        x-model="comment"
                    />

                    <div class="flex">
                        <div class="flex-1 pr-2">
                            <x-input-error for="comment.comment"/>
                        </div>

                        <button 
                            class="px-4 py-1 border border-color-3 rounded-full bg-color-2 transition text-color-1 font-semibold float-right enabled:hover:bg-color-1 enabled:hover:text-color-2 disabled:opacity-50"
                            wire:click="addComment()"
                            x-bind:disabled="comment.length > 0 ? false : true">
                            POST
                        </button>
                    </div>
                </div>
            @else

                <div class="w-full">
                    <div class="w-full py-2 flex justify-center">
                        <i class="fa-solid fa-lock fa-2x text-color-2"></i>
                    </div>
                    <p class="text-center">
                        <a class="text-color-2 underline" href="{{ route('login') }}">Sign In</a> to make posts, comments and much more.
                    </p>
                </div>

            @endif
        </div>

        @foreach ($post->comments->reverse() as $comment)
            <x-comment :comment="$comment" />
        @endforeach
    </div>

</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('storage/js/posts/handleDetailClick.js') }}"></script>
@endpush
