@props(['user'])

<div class="px-4 py-2">
    <h2 class="border-b-[1px] border-color-7 text-color-7 text-lg font-bold">
        Account
    </h2>

    <div class="py-4 flex flex-col gap-12">
        <fieldset class="flex flex-col gap-4">
            <legend class="mb-2 text-color-7 font-bold">Basic</legend>

            <div>
                <label for="name" class="text-color-7 text-[14px] font-semibold">Username</label>
                <x-input 
                    id="name"
                    name="name"
                    class="mt-1 w-full border-none bg-color-5 text-color-7"
                    value="{{ $user->name }}"
                />

                <x-input-error for="name" />
            </div>

            <div>
                <label for="email" class="text-color-7 text-[14px] font-semibold">Email</label>
                <x-input 
                    id="email"
                    name="email"
                    class="mt-1 w-full border-none bg-color-5 text-color-7"
                    value="{{ $user->email }}"
                />

                <x-input-error for="email" />
            </div>
        </fieldset>

        <fieldset class="flex flex-col gap-4">
            <legend class="mb-2 text-color-7 font-bold">Preferences</legend>
            <div class="flex flex-col gap-3"
                x-data="{ checked: '{{ $user->settings->theme }}' }"
                x-init="$watch('checked', value => document.documentElement.className = value == '0' ? 'light' : 'dark')">
                <span class="text-color-7 text-[14px] font-semibold">Privacy</span>
                <p class="italic text-color-4 text-sm font-light">* Setting your profile to private will force users to follow you in order to see your activity (posts, reposts, etc.)</p>

                <div class="w-36 px-4 py-2 border border-color-3 rounded-md flex items-center gap-2 transition-colors" 
                    x-bind:class="checked === '0' ? 'bg-color-2 text-white' : 'text-color-4'">
                    <input 
                        type="radio" 
                        id="light"
                        name="theme"
                        value="0"
                        class="hidden"
                        x-model="checked"
                        x-on:click="checked = '0'"
                    />
                    <label for="light" class="text-[12px] font-semibold">
                        <i class="fa-solid fa-sun fa-xl mr-1 text-yellow-300"></i>
                        Light Mode
                    </label>
                </div>

                <div class="w-36 px-4 py-2 border border-color-3 rounded-md flex items-center gap-2 transition-colors" 
                    x-bind:class="checked === '1' ? 'bg-color-2 text-white' : 'text-color-4'">
                    <input 
                        type="radio" 
                        id="dark"
                        name="theme"
                        value="1"
                        class="hidden"
                        x-model="checked"
                        x-on:click="checked = '1'"
                    />
                    <label for="dark" class="text-[12px] font-semibold">
                        <i class="fa-solid fa-moon fa-xl mr-1"></i>
                        Dark Mode
                    </label>
                </div>
            </div>
        </fieldset>
    </div>
</div>