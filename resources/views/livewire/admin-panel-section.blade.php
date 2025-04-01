<div class="h-full px-4 py-2 pl-20 z-0">
    @switch($section)
        @case('analytics')
            
            <div>
                <h2 class="text-md text-color-7">Analytics</h2>
            </div>

            @break
        @case('reports')

            <div>
                <h2 class="text-md text-color-7">Reports</h2>
            </div>
            
            @break
        @default
            
    @endswitch
</div>