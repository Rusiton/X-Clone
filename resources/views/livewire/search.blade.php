<div class="flex-1 pb-20 flex flex-col overflow-hidden z-0"
    x-data="{ selected: @entangle('header_selection') }">

    <x-report-modal 
        :reportable="$report->reportable" 
        :reportable_model="$report->reportable_model" 
        :already_reported="$report->already_reported" 
    />

    <div class="p-4 flex justify-center">
        <form class="w-full flex justify-evenly" wire:submit="search">
            <input 
                type="text"
                placeholder="Search something..."
                class="flex-1 pl-10 border border-color-3 bg-color-5 rounded-full"
                wire:model="search_input">
            
            <button 
                type="submit" 
                class="mx-4 px-4 border border-color-3 rounded-full bg-color-2 text-white font-bold hover:bg-color-1 hover:text-color-2 transition">
                {{-- SEARCH LOGO HERE --}}
                S
            </button>
        </form>
    </div>

    <div class="flex border-b-2 border-color-5">
        
        <button class="w-1/3 py-4 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'posts' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'posts' ? selected = 'posts' : null; $wire.toggleHeaderSelection(selected)">
            Posts
        </button>

        <button class="w-1/3 py-4 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'profiles' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'profiles' ? selected = 'profiles' : null; $wire.toggleHeaderSelection(selected)">
            Profiles
        </button>

        <button class="w-1/3 py-4 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'tags' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'tags' ? selected = 'tags' : null; $wire.toggleHeaderSelection(selected)">
            Tags
        </button>

    </div>

    <div class="overflow-y-scroll"
        wire:loading.remove 
        wire:target="header_selection">

        @if ($search_results)


            @switch($header_selection)
                @case('posts')

                    @foreach ($search_results as $post)
                        @livewire('post', ['post' => $post, 'search_characters' => $search_input], key($user->id))
                    @endforeach

                    @break
                @case('profiles')
                    
                    @foreach ($search_results as $profile)
                        
                        <div class="w-full px-4 py-2 border-b-2 border-color-5 flex hover:bg-color-5 transition">
                            <div>
                                <a href="{{ route('profile', ['user' => $profile->user->name]) }}">
                                    @if ($profile->picture)
                                        <img class="h-12 rounded-full" src="{{ Storage::url($profile->picture->url) }}">    
                                    @else
                                        <i class="fa-solid fa-circle-user fa-3x"></i>
                                    @endif
                                </a>
                            </div>

                            <div class="pl-2 flex-1">
                                <div class="flex relative" x-data="{ open: false }">
                                    <a href="{{ route('profile', ['user' => $profile->user->name]) }}" class="flex gap-1">
                                        <h2>
                                            {{ strlen($profile->username) >= 15 ? substr($profile->username, 0, 15) . '...' : $profile->username }}
                                        </h2>
                        
                                        <span class="text-sm text-color-4">
                                            {{ strlen($profile->user->name) >= 12 ? '@' . substr($profile->user->name, 0, 12) . '...' : '@' . $profile->user->name }}
                                        </span>
                                    </a>
                        
                                    <div class="flex items-center gap-2 absolute right-0 top-0">
                                        @if ($user)

                                            <span class="cursor-pointer" x-on:click="open = !open">
                                                <i class="fa-solid fa-ellipsis"></i>
                                                asd
                                            </span>
                                            
                                            <div class="w-28 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
                                                x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
                                                wire:loading.remove
                                                wire:target="openReportModal">
                        
                                                @if ($profile->user->id !== $user->id)
                                                    <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                                                        wire:click="openReportModal({{ $profile->id }})"
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
                                        <a href="{{ route('profile', ['user' => $profile->user->name]) }}">
                                            <p class="text-[14px] leading-[18px]">
                                                {{ strlen($profile->biography) > 100 ? substr($profile->biography, 0, 100) . '...' : $profile->biography }}
                                            </p>
                                        </a>    
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach

                    @break
                @case('tags')
                    
            @endswitch
            
        @endif
        
    </div>

    <div class="hidden" 
        wire:loading.class="w-full flex-1 !flex justify-center items-center" 
        wire:target="header_selection">
        <i class="fa-solid fa-circle-notch fa-xl fa-spin"></i>
    </div>
</div>
