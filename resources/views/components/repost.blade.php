@props(['repost', 'user' => false])

<div>
    <div class="pl-[72px] pt-2 italic text-color-4 text-[14px] relative flex items-center"
        wire:key="{{ $repost->id }}">
        <i class="fa-solid fa-retweet absolute left-12"></i> 
        {{ $repost->user->name }} 
        reposted
    </div>

    <x-post 
        :post="$repost->post" 
        :user="$user"
    />
</div>