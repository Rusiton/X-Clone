<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use App\Livewire\Forms\Delete;
use App\Livewire\Forms\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ShowPosts extends Component
{
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



    #[On('like')]
    public function liked($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post_id, $this->user);
    }



    #[On('repost')]
    public function reposted($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post_id, $this->user);
    }



    #[On('openReportModal')]
    public function openReportModal($reportable_id){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($reportable_id, 'Post');
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    #[On('deletePost')]
    public function deleted($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->delete->delete($post_id);
        $this->getPostsSelection();
    }



    public function getFollowing(){
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
            if(!$this->user) return;
            else $this->posts = $this->getFollowing(); return;
        }
    }



    public function mount(){
        $this->user = Auth::user();
        $this->getPostsSelection();
    }



    public function render(){
        return view('livewire.show-posts');
    }
}
