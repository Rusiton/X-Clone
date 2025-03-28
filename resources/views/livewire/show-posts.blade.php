<div class="flex-1 pb-20 flex flex-col overflow-hidden z-0" x-data="{ selected: @entangle('header_selection'), user: '{{ $user ? true : false }}' }">

    <x-report-modal 
        :reportable="$report->reportable" 
        :reportable_model="$report->reportable_model" 
        :already_reported="$report->already_reported" 
    />

    <div class="flex border-b-2 border-color-5">
        
        <button class="w-1/2 py-4 text-color-7 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'latest' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'latest' ? selected = 'latest' : ''; $wire.toggleHeaderSelection(selected)">
            Latest Posts
        </button>

        <button class="w-1/2 py-4 text-color-7 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'following' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'following' ? selected = 'following' : ''; $wire.toggleHeaderSelection(selected)">
            Following
        </button>

    </div>

    <div class="overflow-y-scroll" wire:loading.remove wire:target="header_selection">

        @if ($posts)

            <x-show-elements
                :elements="$posts"
                type="posts"
                :user="$user"
                :route_name="$route_name"
            />

        @else

            @if ($header_selection === 'following')    

                @if (!$user)    

                <div class="w-full p-4">
                    <div class="w-full py-2 flex justify-center">
                        <i class="fa-solid fa-lock fa-2x text-color-2"></i>
                    </div>
                    <p class="text-center">
                        <a class="text-color-2 underline" href="{{ route('login') }}">Sign In</a> to follow others, see their posts and much more.
                    </p>
                    <div class="w-full mt-16 flex justify-center">
                        <a class="w-48 px-4 py-3 bg-color-2 rounded-full flex justify-center items-center text-color-1 font-bold" href="{{ route('login') }}">Sign In</a>
                    </div>
                </div>
                
                @else

                <div class="w-full p-4">
                    <div class="w-full py-2 flex justify-center">
                        <i class="fa-solid fa-question fa-2x text-color-2"></i>
                    </div>
                    <p class="py-2 text-center">
                        You are currently not following anyone.
                    </p>
                    <p class="py-2 text-center">
                        Try <a class="text-color-2 underline" href="{{ route('search') }}">searching</a> for users, or navigate through the application to find what you most like!
                    </p>
                </div>

                @endif
            @endif

        @endif

    </div>

    @if ($user)
        <x-new-post />
    @endif

    <div class="hidden" 
        wire:loading.class="w-full flex-1 !flex justify-center items-center" 
        wire:target="header_selection">
        <i class="fa-solid fa-circle-notch fa-xl fa-spin"></i>
    </div>
</div>

