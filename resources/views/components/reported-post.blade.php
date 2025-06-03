@props(['report'])

<div class="py-2 flex flex-wrap">
    <img src="{{ Storage::url($report->reportable->profile->picture->url) }}" class="w-8 h-8 rounded-full">
    <div class="px-2 flex-1 flex flex-wrap">
        <div class="flex-1 flex justify-between">
            <a href="{{ route('profile', ['name' => $report->reportable->profile->user->name]) }}"
                class="pr-2 flex gap-2">
                <h3 class="text-md text-color-7 font-semibold">{{ $report->reportable->profile->username }}</h3>
                <h3 class="text-sm text-color-4 hover:text-color-2">{{ '@' . $report->reportable->profile->user->name }}
                </h3>
            </a>
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
            <img class="mt-2 border border-color-3 w-full rounded-xl"
                src="{{ Storage::url($report->reportable->picture->url) }}">
        @endif
    </div>

    <div class="mt-4 w-full pl-10 text-color-4">
        <h4 class="w-full text-sm">Reported by
            <a href="{{ route('profile', ['name' => $report->user->name]) }}"
                class="underline transition-colors hover:text-color-2">{{ '@' . $report->user->name }}</a>
        </h4>
        <div class="mt-2">
            <span class="text-sm pr-2">Reason:</span>
            <p class="pl-4 text-xs leading-4">
                {{ $report->reason }}
            </p>
        </div>
    </div>

    <div class="w-full pl-14 py-2 flex justify-between gap-2 text-sm">
        <button class="flex-1 py-1 border border-color-4 rounded-md text-color-4 transition-colors hover:bg-color-5"
            wire:click="fileElement({{ $report->id }})">Discard <i class="fa-solid fa-box-archive"></i></button>
        <button class="flex-1 py-1 border border-color-6 rounded-md text-color-6 transition-colors hover:bg-color-5"
            wire:click="removeElement({{ $report->id }})">Delete item <i class="fa-solid fa-trash"></i></button>
    </div>
</div>
