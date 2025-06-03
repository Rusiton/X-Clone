<?php

namespace App\Livewire;

use Livewire\Component;

class AdminPanelSection extends Component
{
    public $section;



    protected $listeners = [
        'change-section' => 'setSection',
    ];



    public function setSection(string $section){
        $this->section = $section;
    }



    public function mount(){
        $this->section = 'reports';
    }



    public function render()
    {
        return view('livewire.admin-panel-section');
    }
}
