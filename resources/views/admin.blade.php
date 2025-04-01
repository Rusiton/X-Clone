<x-app-layout>
    <div class="h-screen flex flex-col overflow-hidden">
        <div class="p-4 border-b-[1px] border-color-3 bg-color-1">
            <h1 class="text-center text-color-7 text-xl font-bold">X-Clone Administrator Panel</h1>
        </div>

        <div class="flex-1 bg-color-1">

            <div class="w-16 h-full border-r-[1px] border-color-3 bg-color-5 flex flex-col transition-all fixed"
                    x-bind:class="open ? '!w-48 px-4 py-2' : '!w-16 p-2'"
                    x-data="{ open: false, selected: 'analytics' }"
                    x-on:click.outside="open = false">

                <div class="w-full py-4 flex justify-end overflow-hidden">
                    <h2 class="flex-1 flex justify-center items-center whitespace-nowrap text-xl text-color-7 font-bold overflow-hidden transition-all" 
                            x-bind:class="!open && '!max-w-0'">
                            X-Clone
                    </h2>

                    <button class="text-color-7 transition-colors hover:text-color-2"
                            x-on:click="open = !open"
                            x-bind:class="!open && 'w-full'">
                            
                        <i class="fa-solid fa-play fa-2x" x-bind:class="open && 'fa-flip-horizontal'"></i>
                    </button>
                </div>

                <div class="mt-2 flex-1 z-10 flex flex-col gap-2">

                    <x-admin-menu-button
                        name="Analytics"
                        icon="chart-column"
                    />
                    
                    <x-admin-menu-button
                        name="Reports"
                        icon="flag"
                    />

                </div>
            </div>

            @livewire('admin-panel-section')
            
        </div>
    </div>
</x-app-layout>