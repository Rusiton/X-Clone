@props(['tag'])


<a {{ $attributes->merge(['class' => 'text-color-2 italic text-sm']) }} href="">
    {{ '#' . $tag->name }}
</a>