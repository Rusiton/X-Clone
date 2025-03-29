<?php

namespace App\Livewire;

use App\Livewire\Forms\Comment;
use App\Livewire\Forms\Like;
use App\Livewire\Forms\Report;
use App\Livewire\Forms\Repost;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
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



    public function openReportModal(){
        if(!$this->user) return redirect()->route('login');
        $this->report->openReportModal($this->post->id, 'Post');
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');
        $this->report->report();
    }



    public function userHasLike(){
        if(!$this->user) return false;
        return $this->like->userHasLike($this->post, $this->user);
    }



    #[On('toggleLike')]
    public function liked(){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($this->post->id, $this->user->id);
    }



    #[On('toggleRepost')]
    public function reposted(){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($this->post->id, $this->user->id);
    }



    public function userHasRepost(){
        if(!$this->user) return false;
        return $this->repost->userHasRepost($this->post, $this->user);
    }



    public function addComment(){
        if(!$this->user) return redirect()->route('login');
        $this->comment->comment($this->post, $this->user);
    }



    public function mount(){
        if(!$this->post) return redirect()->route('home');
        $this->user = Auth::user();
    }


    
    public function render()
    {
        return view('livewire.post-details');
    }
}
