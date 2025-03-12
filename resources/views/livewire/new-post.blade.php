<div class="h-screen flex flex-col">

    <x-back-header route="home" title="NEW POST" />

    <div class="flex-1 p-4 bg-color-1 flex">
        <div>
            @if ($user->picture)
                <img src="{{ Storage::url($user->picture->url) }}">    
            @else
                <i class="fa-solid fa-circle-user fa-2x"></i>
            @endif
        </div>
        
        <div class="flex-1 pl-2" x-data="{ text: '' }">
            <x-textarea 
                class="w-full h-48 bg-color-5 resize-none"
                placeholder="What's going on?!"
                wire:model.live="text"
                x-model="text"
            />

            <div 
                class="hidden"
                wire:loading.class="mb-2 w-full h-32 rounded-lg bg-color-3 !flex justify-center items-center"
                wire:target="image">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
            </div>

            <div class="w-full">
                @if ($this->getImage())
                    <img class="mb-2 border border-color-3 rounded-lg" src="{{ $this->getImage() }}">
                @endif
            </div>

            <div class="flex-1 max-h-64 pb-2 flex flex-wrap content-start gap-x-2">
                @foreach ($tags as $tag)
                    <div 
                        class="text-color-2 italic flex items-center gap-2 cursor-pointer select-none"
                        wire:click="removeTag({{ $tag }})"
                        x-on:click="$el.remove()">
                        <p class="text-sm">
                            {{ '#' . $this->getTag($tag)->name }}
                        </p>
                        <i class="fa-solid fa-xmark fa-sm"></i>
                    </div>
                @endforeach
            </div>

            <div class="flex items-start">
                <div class="flex gap-4">
                    <div class="relative flex items-center text-color-2">
                        <i class="fa-regular fa-image fa-xl"></i>
                        <input class="w-7 opacity-0 absolute hover:file:cursor-pointer" type="file" wire:model.live="image">
                    </div>
    
                    <div class="relative flex items-center" x-data="{ open: false }">

                        <div class="text-color-2">
                            <i class="fa-solid fa-hashtag fa-xl cursor-pointer" x-on:click="open = !open"></i>
                        </div>
                        
                        <div class="absolute top-10 -left-16 w-48 h-48 bg-color-1 shadow-md overflow-y-scroll" x-show="open" x-on:click.outside="open = false">

                            @foreach ($random_tags as $tag)
                                <div class="px-1 flex items-center gap-2 hover:bg-color-5 transition">
                                    <input type="checkbox" 
                                        class="cursor-pointer"
                                        value="{{ $tag->id }}" 
                                        id="{{ $tag->id }}"
                                        wire:model.live="tags"
                                    >
                                    
                                    <label class="flex-1 py-2 leading-3 cursor-pointer" for="{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="flex-1 px-2">
                    <x-input-error for="text"/>
                    <x-input-error for="image"/>
                    <x-input-error for="tags"/>
                </div>

                <button 
                    class="px-4 py-1 border border-color-3 rounded-full bg-color-2 transition text-color-1 font-semibold float-right enabled:hover:bg-color-1 enabled:hover:text-color-2 disabled:opacity-50"
                    wire:click="save()"
                    x-bind:disabled="text.length > 0 ? false : true">
                    POST
                </button>
            </div>

        </div>
    </div>
    
</div>