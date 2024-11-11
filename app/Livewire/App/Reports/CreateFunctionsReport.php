<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Stage;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class CreateFunctionsReport extends Component
{
    public $categories;
    public $stages;
    public $protocols = ['DASH', 'HLS', 'AMBAS'];
    public $mediaOptions = ['AUDIO', 'VIDEO', 'AMBOS'];
    public $selectedCategory;

    public function mount()
    {
        $this->stages = Stage::whereIn('name', ['CDN TELMEX', 'CDN CEF+'])->get();

        $this->categories = [
            'RESTART' => ['name' => 'RESTART', 'channels' => [$this->initializeChannel(['protocol'])]],
            'CUTV' => ['name' => 'CUTV', 'channels' => [$this->initializeChannel(['protocol'])]],
            'EPG' => ['name' => 'EPG', 'channels' => [$this->initializeChannel([])]],
            'CONTROL PARENTAL' => ['name' => 'CONTROL PARENTAL', 'channels' => [$this->initializeChannel([])]],
        ];
    }

    public function addChannel($categoryName)
    {
        $hasProtocol = in_array($categoryName, ['RESTART', 'CUTV']);
        $this->categories[$categoryName]['channels'][] = $this->initializeChannel($hasProtocol ? ['protocol'] : []);
    }

    public function removeChannel($categoryName, $channelIndex)
    {
        unset($this->categories[$categoryName]['channels'][$channelIndex]);
        $this->categories[$categoryName]['channels'] = array_values($this->categories[$categoryName]['channels']);
    }

    protected function initializeChannel($additionalFields = [])
    {
        $channel = [
            'channel_id' => null,
            'stage' => null,
            'media' => null,
            'description' => '',
        ];

        foreach ($additionalFields as $field) {
            $channel[$field] = '';
        }

        return $channel;
    }

    public function saveReport()
    {
        $report = Report::create([
            'type' => 'Functions',
            'report_date' => now()->toDateString(),
            'reported_by' => Auth::user()->id,
        ]);

        foreach ($this->categories as $category) {
            foreach ($category['channels'] as $channel) {
                ReportDetail::create([
                    'report_id' => $report->id,
                    'channel_id' => $channel['channel_id'],
                    'category' => $category['name'],
                    'stage' => $channel['stage'],
                    'media' => $channel['media'],
                    'protocol' => $channel['protocol'] ?? null,
                    'description' => $channel['description'],
                ]);
            }
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Functions report created successfully.')
        ]);
    }

    public function render()
    {
        return view('livewire.app.reports.create-functions-report', [
            'channels' => Channel::all(),
        ]);
    }
}
