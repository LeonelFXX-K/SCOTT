<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Stage;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class CreateMomentlyReport extends Component
{
    public $category;
    public $stages;
    public $protocols = ['DASH', 'HLS', 'AMBAS'];
    public $mediaOptions = ['AUDIO', 'VIDEO', 'AMBOS'];

    public function mount()
    {
        $this->stages = Stage::all();
        $this->category = [
            'name' => '',
            'channels' => [
                $this->initializeChannel(),
            ],
        ];
    }

    public function addChannel()
    {
        $this->category['channels'][] = $this->initializeChannel();
    }

    public function removeChannel($channelIndex)
    {
        unset($this->category['channels'][$channelIndex]);
        $this->category['channels'] = array_values($this->category['channels']);
    }

    protected function initializeChannel()
    {
        return [
            'channel_id' => null,
            'stage' => null,
            'protocol' => '',
            'media' => '',
            'description' => '',
        ];
    }

    public function saveReport()
    {
        $this->isEditingName = false;

        $report = Report::create([
            'type' => 'Momentary',
            'report_date' => now()->toDateString(),
            'reported_by' => Auth::user()->name,
            'end_time' => null,
            'duration' => null,
            'status' => 'Reciente',
        ]);

        foreach ($this->category['channels'] as $channel) {
            ReportDetail::create([
                'report_id' => $report->id,
                'channel_id' => $channel['channel_id'],
                'category' => $this->category['name'],
                'protocol' => $channel['protocol'],
                'stage' => $channel['stage'],
                'media' => $channel['media'],
                'description' => $channel['description'],
            ]);
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Momentary report created successfully.')
        ]);
    }

    public function getChannelCount($categoryIndex)
    {
        return count($this->category['channels']);
    }

    public function render()
    {
        return view('livewire.app.reports.create-momently-report', [
            'channels' => Channel::all(),
        ]);
    }
}
