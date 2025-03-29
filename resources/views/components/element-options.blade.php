@props(['element', 'type', 'userOwnsThis' => false])

<div x-data="{ open: false }">
    <span class="cursor-pointer text-color-4" x-on:click="open = !open" x-on:click.outside="open = false">
        <i class="fa-solid fa-ellipsis"></i>
    </span>
    
    <div class="w-28 max-h-0 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
        x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
        wire:loading.remove
        wire:target="openReportModal">
    
        @if (!$userOwnsThis)
            <button class="w-full px-4 py-2 text-color-6 cursor-pointer transition hover:bg-color-5" 
                wire:click="openReportModal({{ $element->id }}, '{{ $type }}')"
                x-on:click="open = false">
                <i class="mr-2 fa-solid fa-flag"></i>
                Report
            </button>
        @endif
        
        @if ($userOwnsThis)
            <button class="w-full px-4 py-2 text-color-6 cursor-pointer transition hover:bg-color-5"
                x-on:click="open = false, showConfirmButton({{ $element->id }}, '{{ $type }}')">
                <i class="fa-solid fa-trash"></i>
                Delete
            </button>    
        @endif    
        
    </div>
</div>
