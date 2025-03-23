@props([
    'tag', 
    'search_chars' => '',
    'user' => false,
])

<div class="w-full border-b-2 border-color-5 flex hover:bg-color-5 transition">
    <a href="{{ route('search', ['t' => str_replace(' ', '-', $tag->name)]) }}" class="p-2 flex-1 flex items-center">
        <div class="w-14 h-14 border border-color-2 rounded-full bg-color-1 grid place-content-center">
            <i class="fa-regular fa-hashtag fa-2x"></i>
        </div>

        <div class="flex-1">
            <span class="ml-3 max-w-full overflow-hidden whitespace-nowrap text-lg font-medium">
                {!!
                    '#' . str_replace(
                        $search_chars, 
                        "<span class='font-bold'>$search_chars</span>", 
                        strlen($tag->name) > 22 ? substr($tag->name, 0, 22) . '...' : $tag->name
                    ) 
                !!}
            </span>
        </div>
    </a>

    @if ($user || true)
        <div class="px-4 py-2">
            <i class="fa-solid fa-ellipsis cursor-pointer"></i>
        </div>    
    @endif
</div>