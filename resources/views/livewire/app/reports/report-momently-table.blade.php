<div class="w-full md:w-2/3 pl-6" wire:key="reports-table">
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
                        <input type="text" id="simple-search" wire:model.live="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search') }}" required="" autofocus>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-600 shadow-2xl">
                    <tr>
                        <th scope="col" class="px-4 py-3"><i class="fa-solid fa-tv mr-2"></i>{{ __('Channel') }}</th>
                        <th scope="col" class="px-4 py-3">
                            <i class="fa-solid fa-calendar mr-2"></i>{{ __('Reporting time') }}
                            <a href="#" wire:click.prevent="toggleOrder">
                                <i class="fa-solid fa-sort ms-1.5"></i>
                            </a>
                        </th>

                        <th scope="col" class="px-4 py-3"><i
                                class="fa-solid fa-bars-staggered mr-2"></i>{{ __('Stage') }}</th>
                        <th scope="col" class="px-4 py-3"><i class="fa-solid fa-server mr-2"></i>{{ __('Protocol') }}
                        </th>
                        <th scope="col" class="px-4 py-3"><span class="sr-only"><i
                                    class="fa-solid fa-sliders-h mr-2"></i>{{ __('Options') }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        @foreach ($report->reportDetails ?? [] as $detail)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 cursor-pointer select-none"
                                wire:click="openReportDetails({{ $report->id }})">
                                <td
                                    class="w-[238px] px-4 py-2.5 font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                                    <img src="{{ $detail->channel->image }}" alt=""
                                        class="w-10 h-10 object-center object-contain">
                                    <span class="truncate">{{ $detail->channel->number }}
                                        {{ $detail->channel->name }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-200"><i
                                            class="fa-solid fa-clock mr-1"></i>{{ $report->formatted_date }}</span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-800 dark:text-blue-200"><i
                                            class="fas fa-folder-open mr-1"></i> {{ $detail->stage }}</span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-green-800 bg-green-200 rounded-full dark:bg-green-800 dark:text-green-200">
                                        @if ($detail->protocol == 'DASH')
                                            <i class="fas fa-computer-mouse mr-1"></i>
                                        @elseif ($detail->protocol == 'HLS')
                                            <i class="fas fa-display mr-1"></i>
                                        @elseif ($detail->protocol == 'DASH/HLS')
                                            <i class="fas fa-computer-mouse mr-1"></i>
                                            <i class="fas fa-display mr-1"></i>
                                        @endif
                                        {{ $detail->protocol }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 5">
                                    @if ($report->status === 'Reciente')
                                        <span
                                            class="inline-flex items-center py-2 px-2 text-xs font-semibold bg-green-100 text-green-800 rounded-full dark:bg-green-800 dark:text-green-200">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">{{ __('No reports available.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($selectedReport)
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl max-w-4xl w-full p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white"><i
                                    class="fa-solid fa-file-lines mr-2"></i>{{ __('Report details') }}
                            </h2>
                            <button wire:click="closeReportDetails"
                                class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="sr-only">Close Modal</span>
                            </button>
                        </div>

                        <div
                            class="flex items-center space-x-4 mb-6 rounded-lg shadow-2xl bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 p-4">
                            <img src="{{ $selectedReport->reportDetails->first()->channel->image }}"
                                alt="{{ $selectedReport->reportDetails->first()->channel->name }}"
                                class="w-16 h-16 object-contain object-center">
                            <div>
                                <h4 class="text-lg font-semibold text-white">
                                    {{ $selectedReport->reportDetails->first()->channel->name }}
                                </h4>
                                <p class="text-sm text-gray-50">
                                    {{ __('Channel number:') }}
                                    {{ $selectedReport->reportDetails->first()->channel->number }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Report time and status') }}</h5>
                                <div class="inline-flex items-center space-x-3">
                                    <span
                                        class="inline-block py-1 px-3 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full dark:bg-blue-800 dark:text-blue-200">
                                        <i class="fa-solid fa-calendar-days mr-1"></i>
                                        {{ $selectedReport->report_date }} {{ $selectedReport->start_time }}
                                    </span>
                                    @if ($selectedReport->status === 'Reciente')
                                        <span
                                            class="inline-flex items-center py-1 px-3 text-xs font-semibold bg-green-100 text-green-800 rounded-full dark:bg-green-800 dark:text-green-200">
                                            <i class="fas fa-clock mr-1"></i> {{ $selectedReport->status }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center py-1 px-3 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-800 dark:text-gray-200">
                                            <i class="fas fa-times-circle mr-1"></i> {{ $selectedReport->status }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Reported by') }}</h5>
                                <p class="text-gray-900 dark:text-white flex items-center space-x-2">
                                    <img src="{{ $selectedReport->reportedBy->profile_photo_url }}"
                                        alt="{{ $selectedReport->reportedBy->name }}" class="w-8 h-8 rounded-full">
                                    <span>{{ $selectedReport->reportedBy->name }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                            <div>
                                <h5
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                                    <i class="fas fa-tag mr-1 text-gray-500 dark:text-gray-400"></i>
                                    <span>{{ __('Category') }}</span>
                                </h5>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $selectedReport->reportDetails->first()->category }}
                                </p>
                            </div>

                            <div>
                                <h5
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                                    <i class="fa-solid fa-bars-staggered mr-1 text-gray-500 dark:text-gray-400"></i>
                                    <span>{{ __('Stage') }}</span>
                                </h5>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $selectedReport->reportDetails->first()->stage }}
                                </p>
                            </div>

                            <div>
                                <h5
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                                    <i class="fas fa-server mr-1 text-gray-500 dark:text-gray-400"></i>
                                    <span>{{ __('Protocol') }}</span>
                                </h5>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $selectedReport->reportDetails->first()->protocol }}
                                </p>
                            </div>

                            <div>
                                <h5
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                                    <i class="fas fa-forward mr-1 text-gray-500 dark:text-gray-400"></i>
                                    <span>{{ __('Media') }}</span>
                                </h5>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $selectedReport->reportDetails->first()->media }}
                                </p>
                            </div>

                        </div>

                        @if ($selectedReport->reportDetails->first()->description)
                            <div class="w-full">
                                <h5
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                                    <i class="fas fa-comment mr-1 text-gray-500 dark:text-gray-400"></i>
                                    <span>{{ __('Description') }}</span>
                                </h5>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $selectedReport->reportDetails->first()->description }}
                                </p>
                            </div>
                        @endif

                        <div class="flex justify-end mt-8 space-x-4">
                            <button
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <i class="fas fa-circle-check mr-1.5"></i> {{ __('Mark as solved') }}
                            </button>
                            <button wire:click="closeReportDetails"
                                class="flex items-center gap-2 py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-400 hover:border-red-600 hover:text-red-600 focus:outline-none focus:ring-4 focus:ring-red-200 focus:z-10 transition-colors dark:text-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:hover:text-red-400 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                <i class="fa-solid fa-xmark"></i> {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="p-4">
            {{ $reports->links() }}
        </div>

    </div>
</div>
