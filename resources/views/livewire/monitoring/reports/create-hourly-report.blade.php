<div class="max-h-[70vh] space-y-4 m-3">

    <form wire:submit.prevent="createReport" class="space-y-6">

        <div class="p-4 bg-white rounded-lg shadow-2xl dark:border dark:bg-gray-800 dark:border-gray-700">
            <x-input type="text" wire:model="categoryName" placeholder="{{ __('New category name') }}" />
            <button type="button" wire:click="addCategory" class="mt-4 text-primary-600 hover:underline">
                <i class="fa-solid fa-plus mr-1"></i>
                {{ __('Add Channel') }}
            </button>
        </div>

        @foreach ($categories as $index => $category)
            <div class="p-4 bg-white rounded-lg shadow-2xl dark:border dark:bg-gray-800 dark:border-gray-700">

                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center space-x-2">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">{{ $category['name'] }}</h2>
                        <div class="bg-primary-600 text-white rounded-full flex items-center justify-center w-8 h-8">
                            <span class="font-bold text-sm">{{ count($category['channels']) }}</span>
                        </div>
                    </div>

                    <button type="button" wire:click="removeCategory({{ $index }})"
                        class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 focus:outline-none">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach ($category['channels'] as $channelIndex => $channel)
                        <div class="flex flex-wrap gap-4 items-center">
                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                                    <div class="fa-solid fa-tv mr-1.5"></div>
                                    {{ __('Channel') }}
                                </label>
                                <select
                                    wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.channel_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">{{ __('Select Channel') }}</option>
                                    @foreach ($channels as $ch)
                                        <option value="{{ $ch->id }}">{{ $ch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                                    <i class="fa-solid fa-bars-staggered mr-1.5"></i>
                                    {{ __('Stage') }}
                                </label>
                                <select wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.stage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="">{{ __('Select Stage') }}</option>
                                    @foreach ($stages as $stage)
                                        <option value="{{ $stage->name }}">{{ $stage->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                                    <i class="fa-solid fa-server mr-1.5"></i>
                                    {{ __('Protocol') }}
                                </label>
                                <select
                                    wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.protocol"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="DASH">{{ __('DASH') }}</option>
                                    <option value="HLS">{{ __('HLS') }}</option>
                                    <option value="AMBAS">{{ __('AMBAS') }}</option>
                                </select>
                            </div>

                            <div class="flex-1 min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">
                                    <i class="fa-solid fa-circle-info mr-1.5"></i>
                                    {{ __('Issue') }}
                                </label>
                                <x-input type="text"
                                    wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.issue"
                                    placeholder="{{ __('Describe the issue') }}" />
                            </div>

                            <div class="flex items-center mt-6 md:mt-0">
                                <button type="button"
                                    wire:click="removeChannelFromCategory({{ $index }}, {{ $channelIndex }})"
                                    class="text-sm bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 focus:outline-none">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" wire:click="addChannelToCategory({{ $index }})"
                        class="mt-2 text-primary-600 hover:underline">
                        <i class="fa-solid fa-plus mr-1"></i>
                        {{ __('Add Channel') }}
                    </button>
                </div>
            </div>
        @endforeach

        <div class="flex justify-end space-x-4 mt-6">
            <x-button
                class="bg-primary-600 text-white font-medium rounded-lg px-5 py-2 hover:bg-primary-700 transition">
                <i class="fa-solid fa-floppy-disk mr-1.5"></i>
                {{ __('Create report') }}
            </x-button>
        </div>
        <br>
    </form>
</div>
