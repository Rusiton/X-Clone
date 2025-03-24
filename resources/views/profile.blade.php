<x-app-layout>
    <div class="min-h-screen max-h-screen pb-20 flex flex-col bg-color-1 relative font-poppins"">
        <x-back-header route="{{ request()->query('b', 'home') }}" title="{{ $profile->username }}" />

        <x-profile-card :profile="$profile"/>

        <x-navigation-footer />
    </div>
</x-app-layout>