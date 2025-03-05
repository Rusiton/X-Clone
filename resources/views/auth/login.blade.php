<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="/" class="w-full text-center font-poppins text-3xl font-light">
                X-Clone
            </a>
            <p class="text-center">Log-In</p>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" x-data="formData()">
            @csrf

            <div>

                <x-label for="email" value="{{ __('Email') }}" />

                <x-input 
                    id="email" 
                    class="block mt-1 w-full !rounded-full bg-color-5" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="email" 
                />

            </div>

            <div class="mt-4 relative">

                <x-label for="password" value="{{ __('Password') }}" />

                <span
                    class="absolute right-0 top-0 cursor-pointer"
                    x-on:click="password_visibility = !password_visibility">
                    <i x-bind:class="password_visibility ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                </span>

                <x-input 
                    id="password" 
                    class="block mt-1 w-full !rounded-full bg-color-5" 
                    name="password" 
                    required 
                    autocomplete="password" 
                    x-bind:type="password_visibility ? 'text' : 'password'"
                />

            </div>

            <div class="flex items-center flex-wrap justify-center gap-y-4 mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-color-2" href="{{ route('register') }}">
                    {{ __('Want to make an account?') }}
                </a>

                <x-button class="mx-auto w-full justify-center">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    @push('scripts')
        <script>

            function formData(){
                return {
                    password_visibility: false,
                }
            }

        </script>
    @endpush

</x-guest-layout>
