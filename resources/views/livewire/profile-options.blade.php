<div class="relative" x-data="{ open: false }">
    @if ($user)
        <i class="fa-solid fa-ellipsis-vertical" x-on:click="open = !open" x-on:click.outside="open = false"></i>

        <div class="w-32 max-h-0 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
            x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
            wire:loading.remove
            wire:target="openReportModal">
    
            @if ($user->id !== $profile->user->id)
                <button class="w-full py-4 text-color-6 cursor-pointer transition hover:bg-color-5" 
                    wire:click="openReportModal()"
                    x-on:click="open = false">
                    <i class="mr-2 fa-solid fa-flag"></i>
                    Report
                </button>
            @else
                <button class="w-full py-4 text-color-6 cursor-pointer transition hover:bg-color-5"
                    wire:click="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
                <button class="w-full py-4 text-color-4 cursor-pointer transition hover:bg-color-5"
                    wire:click="settings">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </button>
            @endif    
            
        </div>
    @endif
</div>
