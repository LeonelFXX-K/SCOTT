<div class="w-full md:w-2/3 pl-6">
    <div class="bg-white dark:bg-gray-800 relative shadow-2xl sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search" wire:model.debounce.500ms="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search') }}" required="" autofocus>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-auto flex items-center justify-end space-x-3">
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <i class="fa-solid fa-filter mr-1.5"></i>
                    {{ __('Filter') }}
                    <i class="fa-solid fa-chevron-down ml-1.5"></i>
                </button>
                <div id="filterDropdown" class="z-10 hidden w-64 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <x-checkbox id="inactive-filter" wire:model.live="showInactive"></x-checkbox>
                    <label for="inactive-filter"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Example') }}</label>
                </div>
            </div>
        </div>

        <div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-600 shadow-2xl">
                    <tr>
                        <th scope="col" class="px-4 py-3"><i class="fa-solid fa-tv mr-1"></i>{{ __('Channel') }}</th>
                        <th scope="col" class="px-4 py-3"><i class="fa-solid fa-clock mr-1"></i>{{ __('Time') }}
                        </th>
                        <th scope="col" class="px-4 py-3"><i
                                class="fa-solid fa-bars-staggered mr-1"></i>{{ __('Stage') }}</th>
                        <th scope="col" class="px-4 py-3"><i class="fa-solid fa-server mr-1"></i>{{ __('Protocol') }}
                        </th>
                        <th scope="col" class="px-4 py-3"><i
                                class="fa-solid fa-user-group mr-1"></i>{{ __('Reported by') }}</th>
                        <th scope="col" class="px-4 py-3"><span class="sr-only"><i
                                    class="fa-solid fa-sliders-h mr-1"></i>{{ __('Opciones') }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        @foreach ($report->reportDetails ?? [] as $detail)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                <td
                                    class="px-4 py-2.5 font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                                    <img src="{{ $detail->channel->image }}" alt="Channel Image"
                                        class="w-10 h-10 object-center object-contain">
                                    <span>{{ $detail->channel->name }}</span>
                                </td>

                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-200"><i
                                            class="fa-solid fa-clock mr-1"></i> {{ $report->start_time }}</span>
                                </td>

                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-800 dark:text-blue-200"><i
                                            class="fas fa-folder-open mr-1"></i> {{ $detail->stage }}</span>
                                </td>

                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-800 dark:text-blue-200"><i
                                            class="fas fa-computer mr-1"></i> {{ $detail->protocol }}</span>
                                </td>

                                <td class="px-4 py-2.5">
                                    @if ($report->reportedBy && $report->reportedBy->profile_photo_path)
                                        <div class="relative">
                                            <div id="tooltip-{{ $report->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-6 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                                style="white-space: nowrap;">
                                                {{ $report->reportedBy->name }}
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                            <img data-tooltip-target="tooltip-{{ $report->id }}"
                                                class="w-10 h-10 rounded-full shadow-2xl"
                                                src="{{ asset('storage/' . $report->reportedBy->profile_photo_path) }}"
                                                alt="Reporter Avatar">
                                        </div>
                                    @else
                                        <img class="w-10 h-10 rounded-full shadow-2xl"
                                            src="{{ asset('img/default-avatar.jpg') }}" alt="Default Avatar">
                                    @endif
                                </td>

                                <td class="px-4 py-2.5 flex items-center justify-center">
                                    <button
                                        class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-100 p-3">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                {{ __('No reports available.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
