<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Report as ModelsReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Report extends Form
{
    public $already_reported;
    public $report_open = false;

    public $reportable;
    public $reportable_model;
    
    #[Validate('required|min:15|max:300')]
    public $report_reason;



    public function openReportModal($reportable_id, $model){
        switch ($model) {
            case 'Post':
                $this->reportable = Post::find($reportable_id);
                break;
            
            case 'Comment':
                $this->reportable = Comment::find($reportable_id);
                break;
        }

        if(ModelsReport::where('user_id', Auth::user()->id)
            ->where('reportable_id', $this->reportable->id)
            ->where('reportable_type', "App\Models\\$model")
            ->exists()
        ){
            $this->already_reported = true;
        }
        else{
            $this->already_reported = false;
        }

        $this->reportable_model = ucfirst($model);
        $this->report_open = true;
    }



    public function report(){
        $this->validateOnly('report_reason');

        ModelsReport::create([
            'user_id' => Auth::user()->id,
            'reportable_type' => 'App\Models\\' . $this->reportable_model,
            'reportable_id' => $this->reportable->id,
            'reason' => $this->report_reason,
        ]);

        $this->reset(['already_reported', 'report_open', 'reportable', 'reportable_model', 'report_reason']);
    }
}
