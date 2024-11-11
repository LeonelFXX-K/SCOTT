<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;

class ReportMomentlyTable extends Component
{
    protected $listeners = ['reportCreated' => 'updateReports'];

    public $reports;

    public function mount()
    {
        $this->reports = Report::where('type', 'Momentary')
            ->with(['reportDetails', 'reportedBy'])
            ->get();
    }

    public function updateReports()
    {
        $this->reports = Report::where('type', 'Momentary')
            ->with(['reportDetails', 'reportedBy'])
            ->get();
    }

    public function render()
    {
        return view('livewire.app.reports.report-momently-table', [
            'reports' => $this->reports,
        ]);
    }
}

