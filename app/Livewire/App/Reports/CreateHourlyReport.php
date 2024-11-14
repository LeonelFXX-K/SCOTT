<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\Stage;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CreateHourlyReport extends Component
{
    public $categories = [];
    public $stages;
    public $protocols = ['DASH', 'HLS', 'DASH/HLS'];
    public $mediaOptions = ['AUDIO', 'VIDEO', 'AUDIO/VIDEO'];

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
        try {
            $this->validateReportData();

            $report = Report::create([
                'type' => 'Hourly',
                'report_date' => now()->toDateString(),
                'reported_by' => Auth::user()->id,
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

        } catch (ValidationException $e) {
            $errorMessages = '<ul style="text-align: center;">';
            foreach ($e->validator->errors()->all() as $error) {
                $errorMessages .= "<li>• $error</li>";
            }
            $errorMessages .= '</ul>';

            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => __('Validation error'),
                'html' => $errorMessages
            ]);
        }
    }

    protected function validateReportData()
    {
        foreach ($this->categories as $index => $category) {
            $this->validate([
                "categories.$index.name" => 'required|string|max:255',
                "categories.$index.channels" => 'required|array|min:1',
            ], [], [
                "categories.$index.name" => __('category name'),
                "categories.$index.channels" => __('channels')
            ]);

            foreach ($category['channels'] as $channelIndex => $channel) {
                $this->validate([
                    "categories.$index.channels.$channelIndex.channel_id" => 'required|exists:channels,id',
                    "categories.$index.channels.$channelIndex.protocol" => 'required|in:' . implode(',', $this->protocols),
                    "categories.$index.channels.$channelIndex.media" => 'required|in:' . implode(',', $this->mediaOptions),
                    "categories.$index.channels.$channelIndex.stage" => 'required|exists:stages,name',
                ], [], [
                    "categories.$index.channels.$channelIndex.channel_id" => __('channel'),
                    "categories.$index.channels.$channelIndex.protocol" => __('protocol'),
                    "categories.$index.channels.$channelIndex.media" => __('media'),
                    "categories.$index.channels.$channelIndex.stage" => __('stage')
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.app.reports.create-hourly-report', [
            'channels' => Channel::all(),
        ]);
    }
}
