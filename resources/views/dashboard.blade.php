<x-app-layout>
    <div class="flex flex-col md:flex-row p-6 bg-gray-200 dark:bg-gray-900">
        <div
            class="w-full md:w-1/3 p-6 bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 rounded-lg shadow-2xl flex flex-col items-center space-y-6 h-[400px] overflow-y-auto">
            <div class="w-full flex justify-between items-center mb-4">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ __('User profile picture') }}"
                    class="w-16 h-16 rounded-full shadow-2xl">

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

            <button type="button"
                class="w-full bg-red-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-triangle-exclamation mr-2"></i>
                {{ __('Report channel with faults at the moment') }}
            </button>
            <button type="button" data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                class="w-full bg-green-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-clock mr-2"></i>
                {{ __('General hourly report') }}
            </button>
            <button type="button"
                class="w-full bg-blue-600 text-white rounded-lg py-3 flex items-center justify-center font-semibold shadow-md hover:shadow-2xl transform transition-all hover:scale-105">
                <i class="fas fa-forward mr-2"></i>
                {{ __('Function report') }}
            </button>
        </div>

        <div class="w-full md:w-2/3 pl-6">
            <div class="bg-white dark:bg-gray-800 relative shadow-2xl sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search" required="" autofocus>
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
                        <div id="filterDropdown"
                            class="z-10 hidden w-64 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <x-checkbox id="inactive-filter" wire:model.live="showInactive"></x-checkbox>
                            <label for="inactive-filter"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ __('Example') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-600 shadow-2xl">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    <i class="fa-solid fa-tv mr-1"></i> {{ __('Detalles del canal') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <i class="fa-solid fa-clock mr-1"></i> {{ __('Hora') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <i class="fa-solid fa-layer-group mr-1"></i> {{ __('Etapa y Protocolo') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ __('Problema') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <i class="fa-solid fa-toggle-on mr-1"></i> {{ __('Estado') }}
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">
                                        <i class="fa-solid fa-sliders-h mr-1"></i> {{ __('Opciones') }}
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-4 py-2.5 font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Logotipo_de_TV_Azteca.png"
                                        alt="Channel Image" class="w-10 h-10 object-center object-contain">
                                    <span>101 Azteca UNO</span>
                                </th>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-200">
                                        <i class="fa-solid fa-clock mr-1"></i> 10:30
                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-800 dark:text-blue-200">
                                        <i class="fas fa-folder-open mr-1"></i></i> CDN TELMEX
                                        <span
                                            class="ml-1.5 inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-200 rounded-full dark:bg-green-800 dark:text-green-200">
                                            <i class="fa-solid fa-tv mr-1"></i> HLS
                                        </span>

                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-purple-800 bg-purple-200 rounded-full dark:bg-purple-800 dark:text-purple-200">
                                        <i class="fa-solid fa-video-slash mr-1"></i> Sin video
                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-yellow-800 bg-yellow-200 rounded-full dark:bg-yellow-800 dark:text-yellow-200">
                                        <i class="fas fa-circle-exclamation mr-1"></i> En revisión
                                    </span>
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-4 py-2.5 font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                                    <img src="https://seeklogo.com/images/C/Canal_2-logo-49A780603D-seeklogo.com.png"
                                        alt="Channel Image" class="w-10 h-10 object-center object-contain">
                                    <span>102 Las Estrellas</span>
                                </th>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-200">
                                        <i class="fa-solid fa-clock mr-1"></i> 11:40
                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-800 dark:text-blue-200">
                                        <i class="fas fa-folder-open mr-1"></i></i> CDN CEF+
                                        <span
                                            class="ml-1.5 inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-200 rounded-full dark:bg-green-800 dark:text-green-200">
                                            <i class="fa-solid fa-computer mr-1"></i> DASH
                                        </span>

                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-purple-800 bg-purple-200 rounded-full dark:bg-purple-800 dark:text-purple-200">
                                        <i class="fa-solid fa-volume-xmark mr-1"></i> Sin audio
                                    </span>
                                </td>
                                <td class="px-4 py-2.5">
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-red-800 bg-red-200 rounded-full dark:bg-red-800 dark:text-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Pendiente
                                    </span>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

    <div id="extralarge-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        <i class="fas fa-clock mr-2"></i>
                        {{ __('General hourly report') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="extralarge-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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

</x-app-layout>
