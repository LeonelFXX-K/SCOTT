<x-app-layout>
    <div class="container mx-auto p-6 space-y-8">
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100">
                        <i class="fa-solid fa-file mr-2"></i>{{ __('Report history') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        {{ __('Check your reports segmented by type.') }}
                    </p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg shadow hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">
                    <i class="fa-solid fa-arrow-left mr-2"></i>{{ __('Go back') }}
                </a>
            </div>
        </div>

        <div class="space-y-8">

            <!-- Momentary reports -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
                            <i class="fas fa-triangle-exclamation mr-1.5"></i>
                            {{ __('Report channel with faults at the moment') }}
                        </h2>
                    </div>
                </div>

                <div class="p-6">
                    @if ($momentaryReports->isEmpty())
                        <div class="text-center">
                            <span
                                class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full">
                                <i
                                    class="fa-solid fa-info-circle mr-1"></i>{{ __('No reports have been registered at the moment.') }}
                            </span>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($momentaryReports->groupBy('category') as $category => $reports)
                                <div x-data="{ openCategory: false }"
                                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                    <div class="flex justify-between items-center p-4 cursor-pointer"
                                        @click="openCategory = !openCategory">
                                        <div>
                                            <p class="flex items-center text-sm text-gray-800 dark:text-gray-100">
                                                <i
                                                    class="fa-solid fa-layer-group text-red-600 dark:text-red-300 text-xl mr-1"></i>
                                                <span
                                                    class="font-semibold text-red-700 dark:text-red-300">{{ __('Total reports:') }}</span>
                                                <span
                                                    class="text-gray-900 dark:text-white font-bold ml-1">{{ $reports->count() }}</span>
                                            </p>
                                        </div>
                                        <button class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                            <i class="fa-solid"
                                                :class="openCategory ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                        </button>
                                    </div>

                                    <div x-show="openCategory" x-collapse class="space-y-4 p-4">
                                        @foreach ($reports as $report)
                                            <div x-data="{ openReport: false }"
                                                class="rounded-lg border border-gray-300 dark:border-gray-500 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                                <div class="flex justify-between items-center p-4 cursor-pointer"
                                                    @click="openReport = !openReport">
                                                    <div>
                                                        <span
                                                            class="inline-block py-1 px-3 text-xs font-semibold bg-red-100 text-red-800 rounded-full dark:bg-red-800 dark:text-red-200 shadow-2xl">
                                                            {{ __('Folio:') }}
                                                            {{ $report->id }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-primary-100 text-primary-800 rounded-full dark:bg-primary-800 dark:text-primary-200 shadow-2xl">
                                                            <i class="fa-solid fa-tv mr-1"></i>
                                                            {{ $report->reportDetails->count() }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-800 dark:text-gray-200 shadow-2xl">
                                                            <i class="fa-solid fa-calendar-days mr-1"></i>
                                                            {{ $report->report_date }}
                                                            <i class="fa-solid fa-clock ml-3 mr-1"></i>
                                                            {{ $report->start_time }}
                                                        </span>
                                                    </div>
                                                    <button class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                                        <i class="fa-solid"
                                                            :class="openReport ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                                    </button>
                                                </div>

                                                <div x-show="openReport" x-collapse>
                                                    @foreach ($report->reportDetails as $detail)
                                                        <h3
                                                            class="pl-8 mt-4 text-lg font-bold text-gray-800 dark:text-white flex items-center">
                                                            <i class="fa-solid fa-folder-open text-blue-500 mr-2"></i>
                                                            {{ __('Category:') }} {{ $detail->category }}
                                                        </h3>

                                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <img src="{{ $detail->channel->image }}"
                                                                    alt="{{ $detail->channel->name }}"
                                                                    class="w-20 h-20 object-contain object-center rounded-lg">
                                                                <div>
                                                                    <h4
                                                                        class="text-xl font-semibold text-gray-800 dark:text-white">
                                                                        {{ $detail->channel->name }}
                                                                    </h4>
                                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                                        <strong>{{ __('Channel number') }}</strong>
                                                                        {{ $detail->channel->number }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-server text-green-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Protocol:') }}</strong>
                                                                    {{ $detail->protocol }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-bars-staggered text-purple-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Stage:') }}</strong>
                                                                    {{ $detail->stage }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-forward text-orange-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Media:') }}</strong>
                                                                    {{ $detail->media }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="lg:col-span-2 flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-comment text-gray-400 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Description:') }}</strong>
                                                                    {{ $detail->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Hourly reports -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-lg font-semibold text-green-600 dark:text-green-400">
                            <i class="fas fa-clock mr-1.5"></i>
                            {{ __('General hourly report') }}
                        </h2>
                    </div>
                </div>

                <div class="p-6">
                    @if ($hourlyReports->isEmpty())
                        <div class="text-center">
                            <span
                                class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full">
                                <i
                                    class="fa-solid fa-info-circle mr-1"></i>{{ __('No reports have been registered at the moment.') }}
                            </span>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($hourlyReports->groupBy('category') as $category => $reports)
                                <div x-data="{ openCategory: false }"
                                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                    <div class="flex justify-between items-center p-4 cursor-pointer"
                                        @click="openCategory = !openCategory">
                                        <div>
                                            <p class="flex items-center text-sm text-gray-800 dark:text-gray-100">
                                                <i
                                                    class="fa-solid fa-layer-group text-green-600 dark:text-green-300 text-xl mr-1"></i>
                                                <span
                                                    class="font-semibold text-green-700 dark:text-green-300">{{ __('Total reports:') }}</span>
                                                <span
                                                    class="text-gray-900 dark:text-white font-bold ml-1">{{ $reports->count() }}</span>
                                            </p>
                                        </div>
                                        <button class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                            <i class="fa-solid"
                                                :class="openCategory ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                        </button>
                                    </div>

                                    <div x-show="openCategory" x-collapse class="space-y-4 p-4">
                                        @foreach ($reports as $report)
                                            <div x-data="{ openReport: false }"
                                                class="rounded-lg border border-gray-300 dark:border-gray-500 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                                <div class="flex justify-between items-center p-4 cursor-pointer"
                                                    @click="openReport = !openReport">
                                                    <div>
                                                        <span
                                                            class="inline-block py-1 px-3 text-xs font-semibold bg-green-100 text-green-800 rounded-full dark:bg-green-800 dark:text-green-200 shadow-2xl">
                                                            {{ __('Folio:') }}
                                                            {{ $report->id }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-primary-100 text-primary-800 rounded-full dark:bg-primary-800 dark:text-primary-200 shadow-2xl">
                                                            <i class="fa-solid fa-tv mr-1"></i>
                                                            {{ $report->reportDetails->count() }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-800 dark:text-gray-200 shadow-2xl">
                                                            <i class="fa-solid fa-calendar-days mr-1"></i>
                                                            {{ $report->report_date }}
                                                            <i class="fa-solid fa-clock ml-3 mr-1"></i>
                                                            {{ $report->start_time }}
                                                        </span>
                                                    </div>
                                                    <button class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                                        <i class="fa-solid"
                                                            :class="openReport ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                                    </button>
                                                </div>

                                                <div x-show="openReport" x-collapse>
                                                    @foreach ($report->reportDetails as $detail)
                                                        <h3
                                                            class="pl-8 mt-4 text-lg font-bold text-gray-800 dark:text-white flex items-center">
                                                            <i class="fa-solid fa-folder-open text-blue-500 mr-2"></i>
                                                            {{ __('Category:') }} {{ $detail->category }}
                                                        </h3>

                                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <img src="{{ $detail->channel->image }}"
                                                                    alt="{{ $detail->channel->name }}"
                                                                    class="w-20 h-20 object-contain object-center rounded-lg">
                                                                <div>
                                                                    <h4
                                                                        class="text-xl font-semibold text-gray-800 dark:text-white">
                                                                        {{ $detail->channel->name }}
                                                                    </h4>
                                                                    <p
                                                                        class="text-sm text-gray-600 dark:text-gray-400">
                                                                        <strong>{{ __('Channel number') }}</strong>
                                                                        {{ $detail->channel->number }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-server text-green-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Protocol:') }}</strong>
                                                                    {{ $detail->protocol }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-bars-staggered text-purple-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Stage:') }}</strong>
                                                                    {{ $detail->stage }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-forward text-orange-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Media:') }}</strong>
                                                                    {{ $detail->media }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="lg:col-span-2 flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-comment text-gray-400 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Description:') }}</strong>
                                                                    {{ $detail->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Functions reports -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                            <i class="fas fa-forward mr-1.5"></i>
                            {{ __('Function report') }}
                        </h2>
                    </div>
                </div>

                <div class="p-6">
                    @if ($functionReports->isEmpty())
                        <div class="text-center">
                            <span
                                class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full">
                                <i
                                    class="fa-solid fa-info-circle mr-1"></i>{{ __('No reports have been registered at the moment.') }}
                            </span>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($functionReports->groupBy('category') as $category => $reports)
                                <div x-data="{ openCategory: false }"
                                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                    <div class="flex justify-between items-center p-4 cursor-pointer"
                                        @click="openCategory = !openCategory">
                                        <div>
                                            <p class="flex items-center text-sm text-gray-800 dark:text-gray-100">
                                                <i
                                                    class="fa-solid fa-layer-group text-blue-600 dark:text-blue-300 text-xl mr-1"></i>
                                                <span
                                                    class="font-semibold text-blue-700 dark:text-blue-300">{{ __('Total reports:') }}</span>
                                                <span
                                                    class="text-gray-900 dark:text-white font-bold ml-1">{{ $reports->count() }}</span>
                                            </p>
                                        </div>
                                        <button class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                            <i class="fa-solid"
                                                :class="openCategory ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                        </button>
                                    </div>

                                    <div x-show="openCategory" x-collapse class="space-y-4 p-4">
                                        @foreach ($reports as $report)
                                            <div x-data="{ openReport: false }"
                                                class="rounded-lg border border-gray-300 dark:border-gray-500 bg-gray-50 dark:bg-gray-700 shadow hover:shadow-2xl">
                                                <div class="flex justify-between items-center p-4 cursor-pointer"
                                                    @click="openReport = !openReport">
                                                    <div>
                                                        <span
                                                            class="inline-block py-1 px-3 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full dark:bg-blue-800 dark:text-blue-200 shadow-2xl">
                                                            {{ __('Folio:') }}
                                                            {{ $report->id }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-primary-100 text-primary-800 rounded-full dark:bg-primary-800 dark:text-primary-200 shadow-2xl">
                                                            <i class="fa-solid fa-tv mr-1"></i>
                                                            {{ $report->reportDetails->count() }}
                                                        </span>
                                                        <span
                                                            class="ml-2 inline-block py-1 px-3 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full dark:bg-gray-800 dark:text-gray-200 shadow-2xl">
                                                            <i class="fa-solid fa-calendar-days mr-1"></i>
                                                            {{ $report->report_date }}
                                                            <i class="fa-solid fa-clock ml-3 mr-1"></i>
                                                            {{ $report->start_time }}
                                                        </span>
                                                    </div>
                                                    <button
                                                        class="text-gray-600 dark:text-gray-400 focus:outline-none">
                                                        <i class="fa-solid"
                                                            :class="openReport ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                                    </button>
                                                </div>

                                                <div x-show="openReport" x-collapse>
                                                    @foreach ($report->reportDetails as $detail)
                                                        <h3
                                                            class="pl-8 mt-4 text-lg font-bold text-gray-800 dark:text-white flex items-center">
                                                            <i class="fa-solid fa-folder-open text-blue-500 mr-2"></i>
                                                            {{ __('Category:') }} {{ $detail->category }}
                                                        </h3>

                                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <img src="{{ $detail->channel->image }}"
                                                                    alt="{{ $detail->channel->name }}"
                                                                    class="w-20 h-20 object-contain object-center rounded-lg">
                                                                <div>
                                                                    <h4
                                                                        class="text-xl font-semibold text-gray-800 dark:text-white">
                                                                        {{ $detail->channel->name }}
                                                                    </h4>
                                                                    <p
                                                                        class="text-sm text-gray-600 dark:text-gray-400">
                                                                        <strong>{{ __('Channel number') }}</strong>
                                                                        {{ $detail->channel->number }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-server text-green-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Protocol:') }}</strong>
                                                                    {{ $detail->protocol }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-bars-staggered text-purple-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Stage:') }}</strong>
                                                                    {{ $detail->stage }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-forward text-orange-500 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Media:') }}</strong>
                                                                    {{ $detail->media }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="lg:col-span-2 flex items-center space-x-4 p-4 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm">
                                                                <i
                                                                    class="fa-solid fa-comment text-gray-400 text-2xl"></i>
                                                                <p class="text-gray-800 dark:text-gray-300">
                                                                    <strong>{{ __('Description:') }}</strong>
                                                                    {{ $detail->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
