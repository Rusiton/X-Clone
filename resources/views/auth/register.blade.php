<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="/" class="w-full text-center font-poppins text-3xl font-light">
                X-Clone
            </a>
            <p class="text-center">Register</p>
        </x-slot>

        @switch($registration_stage)
            @case(0)
                <form 
                    method="POST" 
                    action="{{ route('register') }}" 
                    x-data="formData()">
                    @csrf

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />

                        <x-input 
                            id="email" 
                            class="block mt-1 w-full !rounded-full bg-color-5" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autocomplete="email" 
                        />

                        <x-input-error for="email" />
                    </div>

                    <div class="mt-4 relative">
                        <x-label for="password" value="{{ __('Password') }}" />

                        <button
                            type="button"
                            class="absolute right-0 top-0"
                            x-on:click="password_visibility = !password_visibility">
                            <i x-bind:class="password_visibility ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                        </button>

                        <x-input 
                            id="password" 
                            class="block mt-1 w-full !rounded-full bg-color-5"
                            name="password" 
                            required 
                            autocomplete="new-password"
                            x-model="password"
                            x-bind:type="password_visibility ? 'text' : 'password'"
                        />

                        <x-input-error for="password" />
                    </div>

                    <div class="mt-4" x-init="$watch('password_confirm', () => checkPasswords())">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />

                        <x-input 
                            id="password_confirmation" 
                            class="block mt-1 w-full !rounded-full bg-color-5"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" 
                            x-model="password_confirm"
                            x-bind:type="password_visibility ? 'text' : 'password'"
                        />

                        <p 
                            class="mt-1 w-full text-red-600 text-sm"
                            x-show="password_match_error" >
                            Passwords must match!
                        </p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-color-2" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ms-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
                @break

            @case(1)
                <form 
                    method="POST" 
                    action="{{ route('register') }}">
                    @csrf

                    <div>
                        <div class="flex justify-center flex-wrap">
                            <label for="profile_picture" class="p-4 rounded-full bg-color-2 cursor-pointer transition-shadow hover:shadow-gray-400 hover:shadow-sm">
                                <i class="fa-solid fa-image text-color-5 fa-3x"></i>
                            </label>
                            <p class="pt-2 w-full text-center text-color-4">Upload a profile picture</p>
                            <p class="w-full text-center text-color-4 text-sm">(Optional)</p>
                        </div>

                        <div class="py-4 w-full flex justify-center items-center">
                            <x-input 
                                id="profile_picture" 
                                class="hidden" 
                                type="file" 
                                name="profile_picture" 
                                :value="old('profile_picture')"
                                autocomplete="profile_picture" 
                            />
                        </div>

                        <x-input-error for="profile_picture" />
                    </div>

                    <div class="mt-4">
                        <x-label for="username" value="{{ __('User Tag') }}" />

                        <x-input 
                            id="username" 
                            class="block mt-1 w-full !rounded-full bg-color-5" 
                            type="text" 
                            name="username" 
                            :value="old('username')" 
                            required 
                            autocomplete="username" 
                        />

                        <x-input-error for="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="name" value="{{ __('Profile Name') }}" />

                        <x-input 
                            id="name" 
                            class="block mt-1 w-full !rounded-full bg-color-5" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autocomplete="name" 
                        />

                        <x-input-error for="name" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-button class="ms-4">
                            {{ __('Next') }}
                        </x-button>
                    </div>
                        
                </form>
                @break
        @endswitch

    </x-authentication-card>

    @push('scripts')
        <script>

            function formData(){
                return {
                    password: '',
                    password_confirm: '',
                    password_match_error: false,
                    password_visibility: false,
                    
                    checkPasswords() {
                        if(this.password !== this.password_confirm) this.password_match_error = true;
                        else this.password_match_error = false;
                    }
                }
            }

        </script>
    @endpush

</x-guest-layout>
