<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins">
        <h1 class="py-4 text-2xl font-semibold text-color-7 text-center">X-Clone</h1>

        @livewire('show-posts')

        <x-navigation-footer />
    </div>
    
    @push('scripts')
        <script type="text/javascript" src="{{ asset('storage/js/posts/handleElementClick.js') }}"></script>
    @endpush
</x-app-layout>