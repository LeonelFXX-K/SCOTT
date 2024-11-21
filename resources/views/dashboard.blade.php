<x-app-layout>
    <div class="flex flex-col md:flex-row p-6 bg-gray-200 dark:bg-gray-900">
        <div
            class="w-full md:w-1/3 p-6 bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 rounded-lg shadow-2xl flex flex-col items-center space-y-6 h-[400px] overflow-y-auto">
            <div class="w-full flex justify-between items-center mb-4">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ __('User profile picture') }}"
                    class="w-16 h-16 rounded-full shadow-2xl object-center object-cover">

                <div class="text-right text-white ml-auto">
                    <p class="text-xl font-semibold">
                        {{ Auth()->user()->name }}
                    </p>

                    <span id="clock"
                        class="bg-gray-200 text-black text-xs font-semibold py-1 px-3 rounded-full shadow-2xl inline-flex items-center mt-2">
                        <i class="fa-solid fa-clock mr-1"></i>
                        <span id="time" class="w-[78px] text-center">--:--:--</span>
                    </span>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-white mb-4">
                <i class="fa-solid fa-file-lines mr-2"></i>
                {{ __('Generate report') }}
            </h2>

            <button type="button" data-modal-target="create-momently-report-modal"
                data-modal-toggle="create-momently-report-modal"
                class="w-full bg-red-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-triangle-exclamation mr-2"></i>
                {{ __('Report channel with faults at the moment') }}
            </button>
            <button type="button" data-modal-target="create-hourly-report-modal"
                data-modal-toggle="create-hourly-report-modal"
                class="w-full bg-green-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-clock mr-2"></i>
                {{ __('General hourly report') }}
            </button>
            <button type="button" data-modal-target="create-functions-report-modal"
                data-modal-toggle="create-functions-report-modal"
                class="w-full bg-blue-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-forward mr-2"></i>
                {{ __('Function report') }}
            </button>
        </div>

        @livewire('app.reports.report-momently-table')
    </div>

    <script>
        function updateClock() {
            const time = document.getElementById('time');
            const now = new Date();
            time.textContent = now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <div id="create-momently-report-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        <i class="fas fa-triangle-exclamation mr-2 text-red-600"></i>
                        {{ __('Report channel with faults at the moment') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-momently-report-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    @livewire('app.reports.create-momently-report')
                </div>
            </div>
        </div>
    </div>

    <div id="create-hourly-report-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        <i class="fas fa-clock mr-2 text-green-600"></i>
                        {{ __('General hourly report') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-hourly-report-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    @livewire('app.reports.create-hourly-report')
                </div>
            </div>
        </div>
    </div>

    <div id="create-functions-report-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        <i class="fas fa-forward mr-2 text-blue-600"></i>
                        {{ __('General hourly report') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="create-functions-report-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    @livewire('app.reports.create-functions-report')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
