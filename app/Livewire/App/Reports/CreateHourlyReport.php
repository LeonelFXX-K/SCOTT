<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Stage;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class CreateHourlyReport extends Component
{
    public $categories = [];
    public $stages;
    public $protocols = ['DASH', 'HLS', 'AMBAS'];
    public $mediaOptions = ['AUDIO', 'VIDEO', 'AMBOS'];

    public function mount()
    {
        $this->stages = Stage::all();
        $this->addCategory();
    }

    public function addCategory()
    {
        $this->categories[] = [
            'name' => '',
            'channels' => [
                $this->initializeChannel(),
            ],
        ];
    }

    public function removeCategory($index)
    {
        unset($this->categories[$index]);
        $this->categories = array_values($this->categories);
    }

    public function addChannel($categoryIndex)
    {
        $this->categories[$categoryIndex]['channels'][] = $this->initializeChannel();
    }

    public function removeChannel($categoryIndex, $channelIndex)
    {
        unset($this->categories[$categoryIndex]['channels'][$channelIndex]);
        $this->categories[$categoryIndex]['channels'] = array_values($this->categories[$categoryIndex]['channels']);
    }

    protected function initializeChannel()
    {
        return [
            'channel_id' => null,
            'category' => null,
            'stage' => null,
            'protocol' => '',
            'media' => '',
            'description' => '',
        ];
    }

    public function saveReport()
    {
        $report = Report::create([
            'type' => 'Hourly',
            'report_date' => now()->toDateString(),
            'reported_by' => Auth::user()->name,
        ]);

        foreach ($this->categories as $category) {
            foreach ($category['channels'] as $channel) {
                ReportDetail::create([
                    'report_id' => $report->id,
                    'channel_id' => $channel['channel_id'],
                    'category' => $category['name'],
                    'protocol' => $channel['protocol'],
                    'stage' => $channel['stage'],
                    'media' => $channel['media'],
                    'description' => $channel['description'],
                ]);
            }
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('General report created successfully.')
        ]);
    }

    public function render()
    {
        return view('livewire.app.reports.create-hourly-report', [
            'channels' => Channel::all(),
        ]);
    }
}
