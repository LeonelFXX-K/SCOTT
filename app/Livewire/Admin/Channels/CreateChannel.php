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
    public $status = '';

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = collect($validator->errors()->all())->implode('<br>');

                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'html' => __('Your registration for the new channel contains errors.') . '<br>' . '<br>' . __('List of errors:') . '<br>' . '<br>' . $errors,
                ]);
            }
        });
    }

    public function store()
    {
        $this->validate([
            'image_url' => 'required|unique:channels,image_url',
            'number' => 'required|integer|unique:channels,number',
            'number_oktv' => 'nullable|integer',
            'name' => 'required|string',
            'url' => 'nullable|url',
            'status' => 'required|string',
        ], [], [
            'image_url' => __('channel image'),
            'number' => __('channel number'),
            'number_oktv' => __('OKTV channel number'),
            'name' => __('channel name'),
            'url' => __('channel URL'),
            'status' => __('channel status'),
        ]);

        $imageName = time() . '_' . $this->image_url->getClientOriginalName();

        $this->image_url->storeAs('channels', $imageName, 'public');

        $channel = Channel::create([
            'image_url' => 'channels/' . $imageName,
            'number' => $this->number,
            'number_oktv' => $this->number_oktv,
            'name' => $this->name,
            'url' => $this->url,
            'status' => $this->status,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => __('New channel created successfully.')
        ]);

        return redirect()->route('admin.channels.show', $channel);
    }

    public function render()
    {
        return view('livewire.admin.channels.create-channel');
    }
}
