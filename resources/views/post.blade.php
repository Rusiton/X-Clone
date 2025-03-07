<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins"">

        <div class="w-full p-4 border-b-2 border-color-5">
            <a href="{{ route('home') }}" class="flex items-center gap-4">
                <i class="fa-solid fa-arrow-left fa-lg"></i>
                <h1 class="text-xl font-bold">POST</h1>
            </a>
        </div>

        @livewire('post-details', ['post' => $post])        
        
        <x-navigation-footer />

    </div>
</x-app-layout>