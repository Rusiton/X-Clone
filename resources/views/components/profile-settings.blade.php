@props(['profile'])

<div class="px-4 py-2">
    <h2 class="border-b-[1px] border-color-7 text-color-7 text-lg font-bold">
        Profile
    </h2>

    <div class="py-4">
        <fieldset class="flex flex-col gap-4">
            <legend class="mb-2 text-color-7 font-bold">Presentation</legend>

            <div>
                <label for="username" class="text-color-7 text-[14px] font-semibold">Name</label>
                <x-input 
                    id="username"
                    name="username"
                    class="mt-1 w-full border-none bg-color-5 text-color-7"
                    value="{{ $profile->username }}"
                />

                <x-input-error for="username" />
            </div>

            <div>
                <label for="biography" class="text-color-7 text-[14px] font-semibold">Biography</label>
                <x-textarea 
                    id="biography"
                    name="biography"
                    class="mt-1 w-full h-48 border-none bg-color-5 text-color-7"
                    content="{{ $profile->biography }}" 
                />

                <x-input-error for="biography" />
            </div>

            <div class="flex flex-col gap-3"
                x-data="{ checked: '{{ $profile->private }}' }">
                <span class="text-color-7 text-[14px] font-semibold">Privacy</span>
                <p class="italic text-color-4 text-sm font-light">* Setting your profile to private will force users to follow you in order to see your activity (posts, reposts, etc.)</p>

                <div class="w-36 px-4 py-2 border border-color-3 rounded-md flex items-center gap-2 transition-colors" 
                    x-bind:class="checked === '0' ? 'bg-color-2 text-white' : 'text-color-4'">
                    <input 
                        type="radio" 
                        id="public"
                        name="private"
                        value="0"
                        class="hidden"
                        x-model="checked"
                        x-on:click="checked = '0'"
                    />
                    <label for="public" class="text-[12px] font-semibold">
                        <i class="fa-solid fa-lock-open fa-xl mr-1"></i>
                        Public Profile
                    </label>
                </div>

                <div class="w-36 px-4 py-2 border border-color-3 rounded-md flex items-center gap-2 transition-colors" 
                    x-bind:class="checked === '1' ? 'bg-color-2 text-white' : 'text-color-4'">
                    <input 
                        type="radio" 
                        id="private"
                        name="private"
                        value="1"
                        class="hidden"
                        x-model="checked"
                        x-on:click="checked = '1'"
                    />
                    <label for="private" class="text-[12px] font-semibold">
                        <i class="fa-solid fa-lock fa-xl mr-1"></i>
                        Private Profile
                    </label>
                </div>
            </div>
        </fieldset>
    </div>
</div>