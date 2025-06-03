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
    {{ $report_list }}
    <div>
        @switch($sort)
            @case(0)
                @foreach ($report_list as $report)
                    <div class="py-2 flex flex-wrap">
                        <img src="{{ Storage::url($report->reportable->profile->picture->url) }}" class="w-8 h-8 rounded-full">
                        <div class="px-2 flex-1 flex flex-wrap">
                            <div class="flex-1 flex justify-between">
                                <h3 class="text-sm text-color-4">{{ "@" . $report->reportable->profile->user->name }}</h3>
                                <span class="text-xs text-color-4">
                                    {{ $report->reportable->created_at->diffForHumans(null, true, true) }}
                                </span>
                            </div>

                            <div class="w-full">
                                <p class="py-1 text-sm text-color-7 leading-[18px]">
                                    {{ $report->reportable->text }}
                                </p>
                            </div>

                            @if ($report->reportable->picture)
                                <img class="mt-2 border border-color-3 w-full rounded-xl" src="{{ Storage::url($report->reportable->picture->url) }}">
                            @endif
                        </div>

                        <div class="mt-4 w-full pl-10 text-color-4">
                            <h4 class="w-full text-sm">Reported by 
                                <a href="{{ route('profile', ['name' => $report->user->name]) }}" class="underline transition-colors hover:text-color-2">{{ "@" . $report->user->name }}</a>
                            </h4>
                            <div class="mt-2">
                                <span class="text-sm pr-2">Reason:</span>
                                <p class="pl-4 text-xs leading-4">
                                    {{ $report->reason }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full pl-14 py-2 flex justify-between gap-2 text-sm">
                            <button class="flex-1 py-1 border border-color-4 rounded-md text-color-4 transition-colors hover:bg-color-5" wire:click="fileElement({{ $report->id }})">Discard <i class="fa-solid fa-box-archive"></i></button>
                            <button class="flex-1 py-1 border border-color-6 rounded-md text-color-6 transition-colors hover:bg-color-5" wire:click="removeElement({{ $report->id }})">Delete item <i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                @endforeach
                @break

            @case(1)
                
                @break

            @case(2)
                
                @break
        @endswitch
    </div>

</div>