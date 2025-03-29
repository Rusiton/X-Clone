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
                class="flex-1 pl-10 border border-color-3 bg-color-5 rounded-full text-color-7"
                wire:model="search_input">
            
            <button 
                type="submit" 
                class="mx-4 px-6 border border-color-3 rounded-full bg-color-2 text-white font-bold hover:bg-color-1 hover:text-color-2 transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="flex border-b-2 border-color-5 text-color-7">
        
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

        <x-show-elements 
            :elements="$search_results[$header_selection]" 
            :type="$header_selection" 
            :search_chars="$search_input" 
            :user="$user"
            :route_name="$route_name"
        />
        
    </div>

    <div class="hidden" 
        wire:loading.class="w-full flex-1 !flex justify-center items-center" 
        wire:target="header_selection, search">
        <i class="fa-solid fa-circle-notch fa-xl fa-spin"></i>
    </div>
</div>