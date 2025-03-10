<?php

namespace App\Livewire;

use App\Livewire\Forms\Comment;
use App\Livewire\Forms\Like;
use App\Livewire\Forms\Report;
use App\Livewire\Forms\Repost;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PostDetails extends Component
{
    public $user;
    public $post;

    public Report $report;
    public Like $like;
    public Repost $repost;
    public Comment $comment;



    public function openReportModal($reportable_id, $model){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($reportable_id, $model);
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    public function userHasLike(Post $post){
        return $this->like->userHasLike($post, $this->user);
    }



    public function liked(Post $post){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post, $this->user);
    }



    public function reposted(Post $post){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post, $this->user);
    }



    public function userHasRepost(Post $post){
        return $this->repost->userHasRepost($post, $this->user);
    }



    public function addComment(){
        if(!$this->user) return redirect()->route('login');
        $this->comment->comment($this->post, $this->user);
    }


    
    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.post-details');
    }
}
