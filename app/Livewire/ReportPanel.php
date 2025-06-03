<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;

use function PHPSTORM_META\type;

class ReportPanel extends Component
{
    public $sort;
    public $report_list;
    public $skip = 0;



    public function getReportList(){
        $model = $this->sort === 0 ? 'Post' : ($this->sort === 1 ? 'Comment' : 'Profile');
        $this->report_list = Report::where('reportable_type', "App\Models\\$model")
                                    ->where('active', 1)
                                    ->skip($this->skip)
                                    ->take(25)
                                    ->get();
    }



    public function setSort($sort){
        $this->sort = intval($sort);
        $this->getReportList();
    }



    public function fileElement(Report $report){
        $report->active = 0;
        $report->save();
        $this->getReportList();
    }



    public function removeElement(Report $report){
        $report->reportable->delete();
        $this->fileElement($report);
        $this->getReportList();
    }



    public function mount(){
        $this->sort = 0;
        $this->getReportList();
    }



    public function render()
    {
        return view('livewire.report-panel');
    }
}
