<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowPosts extends Component
{
    public $user;
    
    public $header_selection = 'latest';
    public $posts;

    public $report_open = false;
    public $report_post;

    #[Validate('required|min:15|max:300')]
    public $report_reason;



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
    }


    #[On('openReportModal')]
    public function openReportModal(Post $post){
        $this->report_post = $post;
        $this->report_open = true;
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');

        $this->validate();

        Report::create([
            'user_id' => $this->user->id,
            'reportable_type' => 'App\Models\Post',
            'reportable_id' => $this->report_post->id,
            'reason' => $this->report_reason,
        ]);

        $this->report_post = null;
        $this->report_open = false;
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
