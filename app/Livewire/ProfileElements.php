<?php

namespace App\Livewire;

use App\Livewire\Forms\Delete;
use App\Livewire\Forms\Like;
use App\Livewire\Forms\Report;
use App\Livewire\Forms\Repost;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileElements extends Component
{
    public $route_name;

    public $profile;
    public $user;

    public $header_selection;

    public $profile_elements;

    public Report $report;
    public Like $like;
    public Repost $repost;
    public Delete $delete;



    public function setProfileElements(){
        switch($this->header_selection){
            case 'posts':
                $this->profile_elements = $this->profile->posts->sortByDesc('created_at');
                break;
            
            case 'reposts':
                $this->profile_elements = $this->profile->user->reposts->sortByDesc('created_at');
                break;

            case 'replies':
                $this->profile_elements = $this->profile->user->comments->sortByDesc('created_at');
                break;
            
            case 'popular':
            
                break;
        }
    }



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
        $this->setProfileElements();
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
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post_id, $this->user->id);
    }



    public function reposted($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post_id, $this->user->id);
    }



    public function mount(){
        $this->route_name = Route::currentRouteName();
        $this->header_selection = 'posts';
        $this->setProfileElements();
    }



    #[On('delete-element')]
    public function deleted($id, $type){
        if(!$this->user) return redirect()->route('login');
        $this->delete->delete($id, $type);
        $this->setProfileElements();
    }



    public function render()
    {
        return view('livewire.profile-elements');
    }
}
