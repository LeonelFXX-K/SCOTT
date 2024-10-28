<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'icon' => 'fa-solid fa-house',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => __('Stages'),
        'icon' => 'fa-solid fa-bars-staggered',
        'route' => route('admin.stages.index'),
    ],
    [
        'name' => __('Update stage'),
        'icon' => 'fa-solid fa-pen-to-square',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.stages.index') }}"
            class="flex justify-center items-center text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
            <i class="fa-solid fa-arrow-left mr-1.5"></i>
            {{ __('Go back') }}
        </a>
    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                <i class="fa-solid fa-bars-staggered mr-1.5"></i>
                {{ __('Update stage') }}

                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Update the data for this stage.') }}
                </p>
            </h1>

            <!-- Form -->
            <form action="{{ route('admin.stages.update', $stage) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <x-label for="name">
                            <i class="fa-solid fa-bars-staggered mr-1"></i>
                            {{ __('Name') }}
                        </x-label>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $stage->name)" required autofocus autocomplete="name"
                            placeholder="{{ __('Stage name') }}" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status">
                            <i class="fa-solid fa-toggle-on mr-1"></i>
                            {{ __('Status') }}
                        </x-label>
                        <select id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            name="status" required>
                            <option disabled>{{ __('Select status') }}</option>
                            <option value="Activo" @selected(old('status', $stage->status) === 'Activo')>{{ __('Active') }}</option>
                            <option value="Inactivo" @selected(old('status', $stage->status) === 'Inactivo')>{{ __('Inactive') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <x-button class="w-full flex justify-center items-center mt-8">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    {{ __('Update stage') }}
                </x-button>
            </form>
        </div>
    </div>

</x-admin-layout>
