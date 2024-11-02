<?php

namespace App\Livewire\Monitoring\Reports;

use App\Models\Channel;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateHourlyReport extends Component
{
    public $categories = [];
    public $categoryName;
    public $channels = [];
    public $channelIssues = [];
    public $reportDate;
    public $reportedBy;
    public $stages = [];

    public function mount()
    {
        $this->reportDate = now()->toDateString();
        $this->reportedBy = Auth::user()->name;
        $this->stages = Stage::all();

        $this->categories = [
            ['name' => 'ORIGIN BPK', 'channels' => []],
            ['name' => 'CDN TELMEX', 'channels' => []],
            ['name' => 'CDN CEF+', 'channels' => []],
            [
                'name' => 'Canales de música',
                'channels' => Channel::where('category', 'Música')->get()->map(function ($channel) {
                    return [
                        'channel_id' => $channel->id,
                        'issue' => '',
                        'protocol' => '',
                        'stage' => null,
                    ];
                })->toArray(),
            ],
        ];
    }

    public function addChannelToCategory($index)
    {
        $this->categories[$index]['channels'][] = [
            'channel_id' => null,
            'issue' => '',
            'protocol' => '',
            'stage' => null,
        ];
    }

    public function addCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        $this->categories[] = [
            'name' => $this->categoryName,
            'channels' => [],
        ];

        $this->categoryName = '';
    }

    public function createReport()
    {
        $this->validate([
            'categories.*.channels.*.channel_id' => 'required|exists:channels,id',
            'categories.*.channels.*.stage' => 'required|string',
            'categories.*.channels.*.protocol' => 'required|string',
        ], [
            'categories.*.channels.*.channel_id.required' => __('Please select a channel.'),
            'categories.*.channels.*.stage.required' => __('Please select a stage.'),
            'categories.*.channels.*.protocol.required' => __('Please select a protocol.'),
        ]);

        DB::transaction(function () {
            $report = Report::create([
                'type' => 'Hourly',
                'report_date' => $this->reportDate,
                'reported_by' => $this->reportedBy,
                'end_time' => null,
                'duration' => null,
            ]);

            foreach ($this->categories as $category) {
                foreach ($category['channels'] as $channelData) {
                    if ($channelData['channel_id'] && $channelData['stage']) {
                        ReportDetail::create([
                            'report_id' => $report->id,
                            'channel_id' => $channelData['channel_id'],
                            'category' => $category['name'],
                            'protocol' => $channelData['protocol'],
                            'stage' => $channelData['stage'],
                        ]);
                    }
                }
            }
        });

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Report created successfully.')
        ]);
    }


    public function removeChannelFromCategory($categoryIndex, $channelIndex)
    {
        unset($this->categories[$categoryIndex]['channels'][$channelIndex]);

        $this->categories[$categoryIndex]['channels'] = array_values($this->categories[$categoryIndex]['channels']);
    }

    public function removeCategory($index)
    {
        unset($this->categories[$index]);

        $this->categories = array_values($this->categories);
    }

    public function render()
    {
        $this->channels = Channel::all();
        return view('livewire.monitoring.reports.create-hourly-report');
    }
}

