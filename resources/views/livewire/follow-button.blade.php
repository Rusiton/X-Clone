<div>
    @if ($user && $user->id !== $profile->user->id)
        @if ($state)
            <button class="px-4 py-2 rounded-full border border-color-2 bg-color-1 text-color-2 font-bold transition-colors hover:border-color-1 hover:bg-color-6 hover:text-color-7" wire:click="follow">
                Following
            </button>
        @else
            <button class="px-4 py-2 rounded-full border border-color-2 bg-color-2 text-color-7 font-bold transition-colors hover:border-color-2 hover:bg-transparent hover:text-color-2" wire:click="follow">
                Follow
            </button>
        @endif
    @endif
</div>    

