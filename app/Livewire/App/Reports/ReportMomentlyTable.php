<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;

class ReportMomentlyTable extends Component
{
    protected $listeners = ['reportCreated' => 'updatedSearch'];
    public $reports;
    public $search = '';

    public function mount()
    {
        $this->reports = Report::where('type', 'Momentary')
            ->with(['reportDetails', 'reportedBy'])
            ->get();
    }

    public function updatedSearch()
    {
        $this->reports = Report::where('type', 'Momentary')
            ->whereHas('reportDetails', function ($query) {
                $query->whereHas('channel', function ($channelQuery) {
                    $channelQuery->where('number', 'like', '%' . $this->search . '%')
                        ->orWhere('name', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.app.reports.report-momently-table', [
            'reports' => $this->reports,
        ]);
    }
}
