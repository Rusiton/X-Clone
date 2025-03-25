<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins">
        @livewire('search')

        <x-navigation-footer />
    </div>

    @push('scripts')
        <script type="text/javascript" src="{{ asset('storage/js/posts/handleElementClick.js') }}"></script>
    @endpush
</x-app-layout>