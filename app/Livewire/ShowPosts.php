<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use App\Livewire\Forms\Delete;
use App\Livewire\Forms\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ShowPosts extends Component
{
    public $route_name;

    public $user;
    
    #[Url(as: 'h')]
    public ?string $header_selection = 'latest';

    public $posts;

    public Like $like;
    public Repost $repost;
    public Report $report;
    public Delete $delete;



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
        $this->getPostsSelection();
    }



    public function liked($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post_id, $this->user->id);
    }



    public function reposted($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post_id, $this->user->id);
    }



    public function openReportModal($reportable_id, $model){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($reportable_id, $model);
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    #[On('delete-element')]
    public function deleted($id, $type){
        if(!$this->user) return redirect()->route('login');
        $this->delete->delete($id, $type);
        $this->getPostsSelection();
    }



    public function getFollowing(){
        if(!$this->user) return null;
        if(count($this->user->following) < 1) return null;

        $posts = [];

        foreach($this->user->following as $profile) $posts[] = $profile->posts;
        return collect($posts)->collapse();
    }



    public function getPostsSelection(){
        $this->reset('posts');

        if($this->header_selection === 'latest'){
            $this->posts = Post::latest()->get();
            return;
        }

        if($this->header_selection === 'following'){
            $this->posts = $this->getFollowing();
            return;
        }
    }



    public function mount(){
        $this->route_name = Route::currentRouteName();
        $this->user = Auth::user();
        $this->getPostsSelection();
    }



    public function render(){
        return view('livewire.show-posts');
    }
}
