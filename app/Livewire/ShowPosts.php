<?php

namespace App\Livewire;

use App\Livewire\Forms\Report;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowPosts extends Component
{
    public $user;
    
    #[Url(as: 'h')]
    public ?string $header_selection = 'latest';
    public $posts;

    public Report $report;



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
        $this->getPostsSelection();
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
