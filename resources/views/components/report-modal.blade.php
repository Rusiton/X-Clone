@props(['reportable', 'reportable_model', 'already_reported'])

<x-dialog-modal wire:model.live="report.report_open">

    <x-slot name="title">
        @switch($reportable_model)
            @case('Post')
                <h1>Reporting {{ $reportable ? $reportable->profile->user->name : '' }}'s post</h1>
                @break
            @case('Comment')
                <h1>Reporting {{ $reportable ? $reportable->user->name : '' }}'s comment</h1>
                @break
        @endswitch
    </x-slot>

    <x-slot name="content">
        @if (!$already_reported)
            <x-label value="Please, add your report reason:" />
            <x-textarea 
                id="report_reason" 
                wire:model.live="report.report_reason" 
                class="w-full h-64 mt-1 resize-none" 
                required
            />
            
            <x-input-error for="report.report_reason" />                
        @endif
    </x-slot>

    <x-slot name="footer">
        <div class="w-full">

            @if (!$already_reported)
                <p class="mb-4 px-4 py-2 border rounded-md border-color-6 bg-red-200 text-left text-xs text-color-6">
                    <span class="font-bold">Warning:</span>
                    You can only report an element once and you will not be able to remove this report after submitting.
                </p>

                <button 
                    class="px-4 py-2 rounded-md bg-color-1 hover:bg-color-5 text-color-7 font-semibold transition"
                    wire:click="$set('report.report_open', false)">
                    CANCEL
                </button>
                
                <button 
                    class="ml-2 px-4 py-2 rounded-md bg-color-6 enabled:hover:bg-color-2 disabled:opacity-50 text-color-1 font-semibold transition"
                    wire:click="reported()"
                    wire:loading.attr="disabled" 
                    wire:target="reported">
                    REPORT
                </button>
            @else
                <p class="mb-4 px-4 py-2 border rounded-md border-color-6 bg-red-200 text-left text-xs text-color-6">
                    <span class="font-bold">Warning:</span>
                    You already made a report on this element.
                </p>

                <button 
                    class="px-4 py-2 rounded-md bg-color-1 hover:bg-color-5 text-color-7 font-semibold transition"
                    wire:click="$set('report.report_open', false)">
                    CANCEL
                </button>
            @endif
        </div>
    </x-slot>

</x-dialog-modal>