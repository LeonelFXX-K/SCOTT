<x-app-layout>

    <style>
        .invisible-scrollbar {
            overflow: auto;
            scrollbar-width: none;
        }

        .invisible-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

    <div class="text-center">
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4"
            type="button" data-drawer-target="drawer-swipe" data-drawer-show="drawer-swipe" data-drawer-placement="bottom"
            data-drawer-edge="true" data-drawer-edge-offset="bottom-[60px]" aria-controls="drawer-swipe">
            {{ __('Crear reporte') }}
        </button>
    </div>

    <div id="drawer-swipe"
        class="fixed z-40 w-full overflow-y-auto bg-gray-100 border-t border-gray-300 rounded-t-lg dark:border-gray-700 dark:bg-gray-800 transition-transform left-0 right-0 translate-y-full bottom-[60px]"
        tabindex="-1" aria-labelledby="drawer-swipe-label">
        <div class="p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700" data-drawer-toggle="drawer-swipe">
            <span
                class="absolute w-8 h-1 -translate-x-1/2 bg-gray-300 rounded-lg top-3 left-1/2 dark:bg-gray-600"></span>
            <h5 id="drawer-swipe-label"
                class="inline-flex items-center text-base text-gray-500 dark:text-gray-400 font-medium">
                <i class="fa-solid fa-business-time mr-2"></i>
                {{ __('Create hourly report') }}
            </h5>
        </div>

        <div class="p-4 overflow-auto invisible-scrollbar">
            @livewire('monitoring.reports.create-hourly-report')
        </div>
    </div>
</x-app-layout>
