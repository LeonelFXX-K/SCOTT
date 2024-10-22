<?php

namespace App\Livewire\Admin\Channels;

use App\Models\Channel;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateChannel extends Component
{
    use WithFileUploads;

    public $image_url;
    public $number;
    public $number_oktv;
    public $name;
    public $url;

    public $channel = [
        'image_url' => '',
        'number' => '',
        'number_oktv' => '',
        'name' => '',
        'url' => '',
    ];

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = collect($validator->errors()->all())->implode('<br>');

                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'html' => __('Your registration for the new channel contains errors.') . '<br>' . '<br>' . $errors,
                ]);
            }
        });
    }

    public function store()
    {
        $this->validate([
            'image_url' => 'required|unique:channels,image_url',
            'number' => 'required|integer',
            'number_oktv' => 'required|integer',
            'name' => 'required|string',
            'url' => 'nullable|url',
        ], [], [
            'image_url' => 'imagen del canal',
            'number' => 'número del canal',
            'number_oktv' => 'número del canal en OKTV',
            'name' => 'nombre del canal',
            'url' => 'url del canal',
        ]);

        $this->channel['image_url'] = $this->image_url->store('public/channels');

        $channel = Channel::create($this->channel);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => __('New channel created successfully.')
        ]);

        return redirect()->route('admin.channels.edit', $channel);
    }

    public function render()
    {
        return view('livewire.admin.channels.create-channel');
    }
}
