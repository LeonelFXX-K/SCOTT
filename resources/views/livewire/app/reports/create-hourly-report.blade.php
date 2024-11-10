<div>

    <x-validation-errors></x-validation-errors>

    <form wire:submit.prevent="saveReport">
        <div class="space-y-4">

            @foreach ($categories as $index => $category)
                <div x-data="{ open: true, editingName: false }"
                    class="p-4 dark:text-white bg-white dark:bg-gray-700 border rounded-lg shadow-2xl">
                    <div class="flex items-center justify-between cursor-pointer" @click="open = !open">
                        <div class="flex items-center">
                            <button type="button" class="mr-2 text-primary-600" @click="open = !open">
                                <i :class="open ? 'fas fa-chevron-down' : 'fas fa-chevron-right'"></i>
                            </button>

                            <div @click.stop="editingName = true" class="text-lg font-semibold">
                                <template x-if="!editingName">
                                    <h3>{{ $category['name'] ?: __('New category') }}</h3>
                                </template>
                                <template x-if="editingName">
                                    <x-input type="text" wire:model.lazy="categories.{{ $index }}.name"
                                        @click.away="editingName = false" @keydown.enter="editingName = false"
                                        placeholder="{{ __('Category name') }}" autofocus />
                                </template>
                            </div>

                            <span
                                class="ml-2 bg-primary-100 text-primary-800 text-sm font-medium py-1 px-2 rounded-full">
                                {{ __('Contains') }} {{ count($category['channels']) }}
                                {{ count($category['channels']) === 1 ? __('channel') : __('channels') }}
                            </span>
                        </div>
                        <button type="button" wire:click="removeCategory({{ $index }})"
                            class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-500">
                            <i class="fas fa-trash-alt mr-1"></i> {{ __('Delete') }}
                        </button>
                    </div>

                    <div x-show="open" class="mt-4">

                        @foreach ($category['channels'] as $channelIndex => $channel)
                            <div class="p-4 bg-white dark:bg-gray-700 border rounded-lg shadow-2xl mb-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-md font-semibold"><i
                                            class="fa-solid fa-hashtag mr-1"></i>{{ __('Channel') }}
                                        {{ $channelIndex + 1 }}</h4>
                                    <button type="button"
                                        wire:click="removeChannel({{ $index }}, {{ $channelIndex }})"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-500">
                                        <i class="fas fa-times-circle mr-1"></i> {{ __('Remove channel') }}
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            <div class="fa-solid fa-tv mr-1.5"></div>
                                            {{ __('Channel') }}
                                        </label>
                                        <select
                                            wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.channel_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">
                                                {{ __('Select a channel') }}
                                            </option>
                                            @foreach ($channels as $channel)
                                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            <i class="fa-solid fa-bars-staggered mr-1.5"></i>
                                            {{ __('Stage') }}
                                        </label>
                                        <select
                                            wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.stage"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">
                                                {{ __('Select a stage') }}
                                            </option>
                                            @foreach ($stages as $stage)
                                                <option value="{{ $stage->name }}">{{ $stage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            <i class="fa-solid fa-server mr-1.5"></i>
                                            {{ __('Protocol') }}
                                        </label>
                                        <select
                                            wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.protocol"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" disabled selected>
                                                {{ __('Select a protocol') }}
                                            </option>
                                            @foreach ($protocols as $protocol)
                                                <option value="{{ $protocol }}">{{ $protocol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            <i class="fa-solid fa-forward mr-1.5"></i>
                                            {{ __('Audiovisual') }}
                                        </label>
                                        <select
                                            wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.media"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" disabled selected>
                                                {{ __('Select an audiovisual problem') }}
                                            </option>
                                            @foreach ($mediaOptions as $media)
                                                <option value="{{ $media }}">{{ ucfirst($media) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4 mb-2">
                                    <i class="fa-solid fa-comment mr-1.5"></i>
                                    {{ __('Description (Optional)') }}
                                </label>
                                <textarea wire:model="categories.{{ $index }}.channels.{{ $channelIndex }}.description" rows="3"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="{{ __('Enter a description of the problem') }}"></textarea>
                            </div>
                        @endforeach
                        <button type="button" wire:click="addChannel({{ $index }})"
                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 mt-2">
                            <i class="fas fa-plus-circle mr-1"></i> {{ __('Add channel') }}
                        </button>
                    </div>
                </div>
            @endforeach

            <button type="button" wire:click="addCategory"
                class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-500">
                <i class="fas fa-plus-circle mr-1"></i> {{ __('Add a new category') }}
            </button>
        </div>

        <div class="flex justify-end mt-3 space-x-4">
            <x-button type="submit">
                <i class="fas fa-file-lines mr-1.5"></i>
                {{ __('Generate report') }}
            </x-button>
            <button data-modal-hide="create-hourly-report-modal" type="button"
                class="flex items-center gap-2 py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-400 hover:border-primary-600 hover:text-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-200 focus:z-10 transition-colors dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                <i class="fa-solid fa-xmark"></i>
                {{ __('Discard') }}
            </button>
        </div>
    </form>
</div>
