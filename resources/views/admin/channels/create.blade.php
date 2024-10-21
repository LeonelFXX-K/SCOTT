<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'icon' => 'fa-solid fa-house',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => __('Channels'),
        'icon' => 'fa-solid fa-tv',
        'route' => route('admin.channels.index'),
    ],
    [
        'name' => __('Register new channel'),
        'icon' => 'fa-solid fa-plus',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.channels.index') }}"
            class="block text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
            {{ __('Go back') }}
            <i class="fa-solid fa-arrow-rotate-left ml-1"></i>
        </a>
    </x-slot>

    <div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                {{ __('Register new channel') }}
                <i class="fa-solid fa-tv ml-1"></i>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Enter the data for the new channel.') }}
                    <i class="fa-solid fa-circle-info ml-1"></i>
                </p>
            </h1>

            <!-- Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Form -->
            <form method="POST" action="">
                @csrf

                <div>
                    <x-label for="number" value="{{ __('Number') }}" />
                    <x-input id="number" class="block mt-1 w-full" type="number" name="number" :value="old('number')"
                        required autofocus autocomplete="number" placeholder="{{ __('Channel number') }}" />
                </div>

                <div class="mt-4">
                    <x-label for="number_oktv" value="{{ __('OKTV Number') }}" />
                    <x-input id="number_oktv" class="block mt-1 w-full" type="number" name="number_oktv" :value="old('number_oktv')"
                        required autocomplete="number_oktv" placeholder="{{ __('Channel number on OKTV') }}" />
                </div>

                <div class="mt-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autocomplete="name" placeholder="{{ __('Channel name') }}" />
                </div>

                <div class="mt-4">
                    <x-label for="url" value="{{ __('URL') }}" />
                    <x-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')"
                        required autocomplete="url" placeholder="{{ __('Channel URL') }}" />
                </div>

                <!-- Submit -->
                <x-button class="w-full flex justify-center items-center mt-8">
                    {{ __('Register new channel') }}
                    <i class="fa-solid fa-floppy-disk ml-2"></i>
                </x-button>
            </form>
        </div>
    </div>

</x-admin-layout>
