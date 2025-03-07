@props(['disabled' => false, 'placeholder' => false])

<textarea {{ $disabled ? 'disabled' : '' }} @if($placeholder) placeholder="{{ $placeholder }}" @endif {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-color-2 rounded-md shadow-sm']) !!}></textarea>
