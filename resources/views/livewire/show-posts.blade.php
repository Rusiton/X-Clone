<div class="flex-1 pb-20 flex flex-col overflow-hidden z-0" 
    x-data="{ selected: @entangle('header_selection'), user: '{{ $user ? true : false }}' }">

    <x-report-modal 
        :reportable="$report->reportable" 
        :reportable_model="$report->reportable_model" 
        :already_reported="$report->already_reported" 
    />

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
