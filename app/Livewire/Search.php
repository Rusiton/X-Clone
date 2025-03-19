<?php

namespace App\Livewire;

use App\Livewire\Forms\Report;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    public $user;

    #[Url(as: 's')]
    public $search_input = '';

    #[Url(as: 'h')]
    public $header_selection = 'posts';

    public $search_results = [];

    public Report $report;



    public function search(){
        $this->reset('search_results');
        if($this->search_input !== '') $this->search_results = $this->getSearchResults();
    }



    public function getSearchResults(){
        if($this->header_selection === 'posts') return Post::where('text', 'like', '%' . $this->search_input . '%')->get();

        if($this->header_selection === 'profiles') return Profile::where('username', 'like', '%' . $this->search_input . '%')->get();

        if($this->header_selection === 'tags') return Tag::where('name', 'like', '%' . $this->search_input . '%')->get();
    }



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
        $this->search_results = $this->search_input === '' ? null : $this->getSearchResults();
    }



    #[On('openReportModal')]
    public function openReportModal($reportable_id){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($reportable_id, 'Profile');
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    public function mount(){
        $this->user = Auth::user();
        $this->search_results = $this->search_input !== '' ? $this->getSearchResults() : [];
    }



    public function render()
    {
        return view('livewire.search');
    }
}
