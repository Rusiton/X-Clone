<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins"">

        <x-back-header route="{{ request()->query('b', 'home') }}" title="POST" />

        @livewire('post-details', ['post' => $post])        
        
        <x-navigation-footer />

    </div>
</x-app-layout>