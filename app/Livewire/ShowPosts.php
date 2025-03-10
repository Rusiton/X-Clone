<?php

namespace App\Livewire;

use App\Livewire\Forms\Report;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowPosts extends Component
{
    public $user;
    
    public $header_selection = 'latest';
    public $posts;

    public Report $report;



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
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



    public function render(){
        $this->user = Auth::user();

        switch ($this->header_selection) {
            case 'latest':
                $this->posts = Post::all()->sortByDesc('id');
                break;

            case 'following':
                $this->posts = [];

                foreach($this->user->following as $profile){
                    Post::where('profile_id', $profile->id)->latest()->each(function ($post) {
                        array_push($this->posts, $post);
                    }); 
                }

                break;
            
            default:
                $this->posts = null;
                break;
        }

        return view('livewire.show-posts');
    }
}
