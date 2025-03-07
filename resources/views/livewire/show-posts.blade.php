<div class="flex-1 pb-20 flex flex-col overflow-hidden z-0" 
    x-data="{ selected: @entangle('header_selection'), user: '{{ $user ? true : false }}' }">

    <x-dialog-modal wire:model.live="report_open">
        
        <x-slot name="title">
            <h1>Reporting {{ $report_post ? $report_post->profile->user->name : '' }}'s post</h1>
        </x-slot>

        <x-slot name="content">
            <x-label value="Please, add your report reason:" />
            <x-textarea 
                id="report_reason" 
                wire:model.live="report_reason" 
                class="w-full h-64 mt-1 resize-none" 
                required
            />
            
            <x-input-error for="report_reason" />
        </x-slot>

        <x-slot name="footer">
            <div class="w-full">
                <p class="mb-4 px-4 py-2 border rounded-md border-color-6 bg-red-200 text-left text-xs text-color-6">
                    <span class="font-bold">Warning:</span>
                    You can only report a post once and you will not be able to remove this report after submitting.
                </p>

                <button 
                    class="px-4 py-2 rounded-md bg-color-1 hover:bg-color-5 text-color-7 font-semibold transition"
                    wire:click="$set('report_open', false)">
                    CANCEL
                </button>
                <button 
                    class="ml-2 px-4 py-2 rounded-md bg-color-6 enabled:hover:bg-color-2 disabled:opacity-50 text-color-1 font-semibold transition"
                    wire:click="reported()"
                    wire:loading.attr="disabled" 
                    wire:target="reported">
                    REPORT
                </button>
            </div>
        </x-slot>

    </x-dialog-modal>

    <div class="flex border-b-2 border-color-5">
        
        <button class="w-1/2 py-4 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'latest' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'latest' ? selected = 'latest' : ''; $wire.toggleHeaderSelection(selected)">
            Latest Posts
        </button>

        <button class="w-1/2 py-4 font-semibold transition flex justify-center relative"
            x-bind:class="selected == 'following' ? 'bg-color-5 after:absolute after:bottom-0 after:h-1 after:w-24 after:bg-color-2' : ''"
            x-on:click="selected != 'following' ? selected = 'following' : ''; $wire.toggleHeaderSelection(selected)">
            Following
        </button>

    </div>

    <div class="overflow-y-scroll" wire:loading.remove wire:target="header_selection">

        @foreach ($posts as $post)
            @livewire('post', ['post' => $post], key($post->id))
        @endforeach

    </div>

    <div class="hidden" 
        wire:loading.class="w-full flex-1 !flex justify-center items-center" 
        wire:target="header_selection">
        <i class="fa-solid fa-circle-notch fa-xl fa-spin"></i>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('storage/js/posts/postInteractionControl.js') }}"></script>
@endpush
