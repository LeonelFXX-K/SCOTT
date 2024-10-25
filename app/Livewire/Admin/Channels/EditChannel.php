<?php

namespace App\Livewire\Admin\Channels;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Channel;
use Illuminate\Support\Facades\Storage;

class EditChannel extends Component
{
    use WithFileUploads;

    public $channel;
    public $number;
    public $number_oktv;
    public $name;
    public $url;
    public $status;
    public $image_url;
    public $new_image;

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = collect($validator->errors()->all())->implode('<br>');

                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'html' => __('Your update contains errors.') . '<br>' . '<br>' . __('List of errors:') . '<br>' . '<br>' . $errors,
                ]);
            }
        });
    }

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
        $this->number = $channel->number;
        $this->number_oktv = $channel->number_oktv;
        $this->name = $channel->name;
        $this->url = $channel->url;
        $this->status = $channel->status;
        $this->image_url = $channel->image_url;
    }

    public function update()
    {
        $this->validate([
            'number' => 'required|integer|unique:channels,number,' . $this->channel->id,
            'number_oktv' => 'nullable|integer',
            'name' => 'required|string',
            'url' => 'nullable|url',
            'status' => 'required|string',
            'new_image' => 'nullable|image',
        ], [], [
            'number' => __('channel number'),
            'number_oktv' => __('OKTV channel number'),
            'name' => __('channel name'),
            'url' => __('channel URL'),
            'status' => __('channel status'),
            'new_image' => __('new channel image'),
        ]);

        if ($this->new_image) {
            if ($this->image_url && Storage::exists($this->image_url)) {
                Storage::delete($this->image_url);
            }

            $imageName = time() . '_' . $this->new_image->getClientOriginalName();
            $this->image_url = $this->new_image->storeAs('channels', $imageName, 'public');
        }

        $this->channel->update([
            'number' => $this->number,
            'number_oktv' => $this->number_oktv,
            'name' => $this->name,
            'url' => $this->url,
            'status' => $this->status,
            'image_url' => $this->image_url,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Channel updated successfully.')
        ]);

        return redirect()->route('admin.channels.show', $this->channel);
    }

    public function render()
    {
        return view('livewire.admin.channels.edit-channel');
    }
}
