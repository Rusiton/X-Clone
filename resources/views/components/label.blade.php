@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-color-4']) }}>
    {{ $value ?? $slot }}
</label>
