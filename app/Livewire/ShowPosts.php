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

    public $already_reported;
    public $report_open = false;
    public $report_post;

    #[Validate('required|min:15|max:300')]
    public $report_reason;



    public function toggleHeaderSelection($selection){
        $this->header_selection = $selection;
    }


    #[On('openReportModal')]
    public function openReportModal(Post $post){
        if(!$this->user) return redirect()->route('login');

        $this->report_post = $post;

        if(Report::where('user_id', $this->user->id)
            ->where('reportable_id', $this->report_post->id)
            ->where('reportable_type', 'App\Models\Post')
            ->exists()
        ){
            $this->already_reported = true;
        }
        else{
            $this->already_reported = false;
        }

        $this->report_open = true;
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');

        $this->validateOnly('report_reason');

        Report::create([
            'user_id' => $this->user->id,
            'reportable_type' => 'App\Models\Post',
            'reportable_id' => $this->report_post->id,
            'reason' => $this->report_reason,
        ]);

        $this->reset(['report_open', 'report_post', 'report_reason']);
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
