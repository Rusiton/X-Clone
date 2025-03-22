<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Report;
use App\Livewire\Forms\Repost;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    public $route_name;

    public $user;

    #[Url(as: 's')]
    public $search_input = '';

    #[Url(as: 'h')]
    public $header_selection = 'posts';

    public $search_results = ['posts' => [], 'profiles' => [], 'tags' => []];

    public Like $like;
    public Repost $repost;
    public Report $report;



    public function search(){
        if($this->search_input === '') $this->reset('search_results');
        $this->getSearchResults();
    }


    
    public function updatedSearchInput(){
        $this->dispatch('update-search-chars', $this->search_input);
    }



    public function getSearchResults(){
        if($this->search_input === '') return;

        $this->search_results['posts'] = Post::where('text', 'like', '%' . $this->search_input . '%')->get();

        $this->search_results['profiles'] = Profile::where('username', 'like', '%' . $this->search_input . '%')->get();
        $this->search_results['profiles'] = $this->search_results['profiles']->merge(Profile::where('biography', 'like', '%' . $this->search_input . '%')->get());

        $this->search_results['tags'] = Tag::where('name', 'like', '%' . $this->search_input . '%')->get();
    }



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
        $this->getSearchResults();
    }



    public function openReportModal($reportable_id, $model){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($reportable_id, $model);
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    public function liked($post_id){
        $this->like->like($post_id, $this->user->id);
    }



    public function reposted($post_id){
        $this->repost->repost($post_id, $this->user->id);
    }



    public function mount(){
        $this->route_name = Route::currentRouteName();
        $this->user = Auth::user();
        $this->getSearchResults();
    }



    public function render()
    {
        return view('livewire.search');
    }
}
