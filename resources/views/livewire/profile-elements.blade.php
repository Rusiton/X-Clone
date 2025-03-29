<div class="flex-1 flex flex-col" 
    x-data="{ selected: @entangle('header_selection') }">

    <x-report-modal 
        :reportable="$report->reportable" 
        :reportable_model="$report->reportable_model" 
        :already_reported="$report->already_reported" 
    />

    <div class="flex border-b-2 border-color-5 text-color-7">
        
        <button class="w-1/3 py-3 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'posts' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'posts' ? selected = 'posts' : null, $wire.toggleHeaderSelection(selected)">
            Posts
        </button>

        <button class="w-1/3 py-3 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'reposts' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'reposts' ? selected = 'reposts' : null, $wire.toggleHeaderSelection(selected)">
            Reposts
        </button>

        <button class="w-1/3 py-3 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'replies' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'replies' ? selected = 'replies' : null, $wire.toggleHeaderSelection(selected)">
            Replies
        </button>

        <button class="w-1/3 py-3 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'popular' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'popular' ? selected = 'popular' : null, $wire.toggleHeaderSelection(selected)">
            Popular
        </button>

    </div>

    <div wire:loading.remove wire:target="toggleHeaderSelection">
        @switch($header_selection)
            @case('posts')
                @foreach ($profile_elements as $post)
                    <x-post 
                        :post="$post" 
                        :user="$user"
                    />
                @endforeach
                @break

            @case('reposts')
                @foreach ($profile_elements as $repost)
                    <x-repost
                        :repost="$repost" 
                        :user="$user"
                    />
                @endforeach
                @break

            @case('replies')
                @foreach ($profile_elements as $reply)
                    <x-reply
                        :reply="$reply" 
                        :user="$user"
                    />
                @endforeach
                @break

            @case('popular')
                @foreach ($profile_elements as $post)
                    <x-post 
                        :post="$post" 
                        :user="$user"
                    />
                @endforeach
                @break
        @endswitch
    </div>

    @if ($user)
        <x-new-post />
    @endif

    <div class="hidden" 
        wire:loading.class="flex-1 !flex justify-center items-center" 
        wire:target="toggleHeaderSelection">
        <i class="fa-solid fa-circle-notch fa-xl fa-spin text-color-7"></i>
    </div>
</div>
