<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins">
        <h1 class="py-4 text-2xl font-semibold text-center">X-Clone</h1>

        @livewire('show-posts')

        <x-navigation-footer />
    </div>
</x-app-layout>