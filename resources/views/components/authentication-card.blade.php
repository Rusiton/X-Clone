<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-blue-200">
    <div class="w-5/6 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 pb-4 border-b-2 flex flex-wrap justify-center">
            {{ $logo }}
        </div>
    
        <div>
            {{ $slot }}
        </div>
    </div>
    
</div>
