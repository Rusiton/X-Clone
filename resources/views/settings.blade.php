<x-app-layout>
    <div class="min-h-screen max-h-screen flex flex-col bg-color-1 relative font-poppins">
        <x-back-header title="SETTINGS" />

        <div class="flex-1 pb-20 flex flex-col overflow-x-hidden overflow-y-scroll z-0">
            <form action="{{ route('settings') }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    {{ $errors }}
                @endif

                <x-profile-settings :profile="$user->profile" />
                <x-user-settings :user="$user" />

                <button 
                    type="submit" 
                    class="my-2 mr-4 px-4 py-2 rounded-lg bg-color-2 float-right text-white font-semibold ">
                    SAVE
                </button>
            </form>
        </div>

        <x-navigation-footer />
    </div>
</x-app-layout>