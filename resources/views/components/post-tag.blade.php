@props(['tag'])


<a {{ $attributes->merge(['class' => 'text-color-2 italic']) }} href="">
    {{ '#' . $tag->name }}
</a>