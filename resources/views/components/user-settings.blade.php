@props(['user'])

<div class="px-4 py-2">
    <h2 class="border-b-[1px] border-color-7 text-color-7 text-lg font-bold">
        Account
    </h2>

    <div class="py-4">
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
    </div>
</div>