<x-app-layout>
    <div class="min-h-screen max-h-screen pb-20 flex flex-col bg-color-1 relative font-poppins"">
        <x-back-header title="{{ $profile->username }}" />

        <x-profile-card :profile="$profile"/>

        <x-navigation-footer />
    </div>

    @push('scripts')
        <script type="text/javascript" src="{{ asset('storage/js/posts/handleElementClick.js') }}"></script>
    @endpush
</x-app-layout>