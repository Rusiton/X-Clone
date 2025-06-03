<div class="h-full max-h-screen px-4 py-2 pl-16 pb-16 z-0 flex flex-col">
    @switch($section)
        @case('reports')

            @livewire('report-panel')
            
            @break
        @default {{ $this->setSection('reports') }}
            
    @endswitch
</div>