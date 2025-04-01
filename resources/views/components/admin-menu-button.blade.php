@props(['name', 'icon'])

<div class="w-full border-[1px] border-transparent px-4 py-2 rounded-md flex justify-center items-center select-none cursor-pointer transition-colors hover:border-color-2 hover:bg-color-1"
        x-bind:class="{ 'gap-4': open, '!border-color-2 bg-color-1': selected === '{{ strtolower($name) }}' }"
        x-on:click="selected = '{{ strtolower($name) }}', Livewire.dispatch('change-section', { section: '{{ strtolower($name) }}' })">

    <i class="fa-solid fa-{{ $icon }} fa-xl text-color-7"></i>
    <h3 class="flex-1 overflow-hidden text-color-7 font-semibold transition-all" 
        x-bind:class="!open && 'max-w-0'">
        {{ ucfirst($name) }}
    </h3>
</div>