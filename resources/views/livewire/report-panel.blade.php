<div class="h-full px-4 overflow-y-auto">
    <h2 class="mb-4 text-md text-color-4">Reports</h2>
    <div class="flex gap-2 text-sm">
        <span class="text-color-7">Sort by:</span>
        <div class="flex-1 flex gap-2 text-color-4" x-data="{ checked: '0' }" x-init="$watch('checked', () => $wire.setSort(checked))">
            <input type="radio" id="sort_posts" value="0" class="hidden" x-on:click="checked = '0'">
            <label 
                for="sort_posts" 
                class="px-2 border rounded-md border-color-4" 
                x-model="checked" 
                x-bind:class="checked === '0' && '!border-color-2 !text-color-2'">
                Posts
            </label>

            <input type="radio" id="sort_comments" value="1" class="hidden" x-on:click="checked = '1'">
            <label 
                for="sort_comments" 
                class="px-2 border rounded-md border-color-4" 
                x-model="checked" 
                x-bind:class="checked === '1' && '!border-color-2 !text-color-2'">
                Comments
            </label>

            <input type="radio" id="sort_users" value="2" class="hidden" x-on:click="checked = '2'">
            <label 
                for="sort_users" 
                class="px-2 border rounded-md border-color-4" 
                x-model="checked"
                x-bind:class="checked === '2' && '!border-color-2 !text-color-2'">
                Users
            </label>
        </div>
    </div>
    
    <div>
        @switch($sort)
            @case(0)
                @foreach ($report_list as $report)
                    <x-reported-post :report="$report" />
                @endforeach
                @break

            @case(1)
                @foreach ($report_list as $report)
                    <x-reported-comment :report="$report" />
                @endforeach
                @break

            @case(2)
                @foreach ($report_list as $report)
                    <x-reported-profile :report="$report" />
                @endforeach
                @break
        @endswitch

        @if (!count($report_list))
            <div class="w-full h-56 flex flex-wrap justify-center items-center">
                <div class="h-fit flex flex-wrap justify-center">
                    <i class="fa-solid fa-check fa-4x text-color-4"></i>
                    <p class="w-full mt-4 text-center text-lg text-color-4">Nothing to see here...</p>
                    <p class="w-full text-center text-sm text-color-4">All reports on this section were already reviewed.</p>
                </div>
            </div>
        @endif
    </div>

</div>