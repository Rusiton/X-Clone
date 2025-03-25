@props(['element', 'type', 'userOwnsThis' => false])

<div x-data="{ open: false }">
    <span class="cursor-pointer" x-on:click="open = !open">
        <i class="fa-solid fa-ellipsis"></i>
    </span>
    
    <div class="w-28 shadow-lg bg-color-1 flex flex-wrap absolute right-4 top-0 z-10 transition-all overflow-hidden"
        x-bind:class="open ? 'max-h-screen' : 'max-h-0'"
        wire:loading.remove
        wire:target="openReportModal">
    
        @if (!$userOwnsThis)
            <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition" 
                wire:click="openReportModal({{ $element->id }})"
                x-on:click="open = false">
                Report
            </button>
        @endif
        
        @if ($userOwnsThis)
            <button class="w-full px-4 py-2 cursor-pointer hover:bg-color-5 transition text-color-6"
                x-on:click="open = false, showConfirmButton({{ $element->id }}, '{{ $type }}')">
                Delete
            </button>    
        @endif    
        
    </div>
</div>
