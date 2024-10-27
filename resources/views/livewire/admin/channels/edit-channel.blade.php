<x-slot name="action">
    <a href="{{ route('admin.channels.index') }}"
        class="flex justify-center items-center text-white bg-gray-600 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
        <i class="fa-solid fa-arrow-left mr-1.5"></i>
        {{ __('Go back') }}
    </a>
</x-slot>

<div class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            <i class="fa-solid fa-tv mr-1.5"></i>
            {{ __('Update channel') }}

            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                {{ __('Update the data for this channel.') }}
            </p>
        </h1>

        <!-- Form -->
        <form wire:submit.prevent="update">
            @csrf

            <div class="mt-4 md:mt-0">
                <!-- Image -->
                <figure
                    class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 mb-4 relative dark:bg-gray-700 dark:border-gray-600"
                    style="min-height: 100%;">
                    <div class="absolute right-20 p-4 pt-6">
                        <x-label
                            class="flex items-center px-4 py-2 rounded-lg bg-primary-600 cursor-pointer text-white">
                            <i class="fas fa-image mr-2"></i>
                            {{ __('Update image') }}
                            <input type="file" class="hidden" accept="image/*" wire:model="new_image">
                        </x-label>
                    </div>
                    <img class="aspect-[16/9] object-contain object-center w-full rounded-lg"
                        src="{{ $new_image ? $new_image->temporaryUrl() : ($image_url ? asset('storage/' . $image_url) : asset('img/no-image.png')) }}"
                        alt="">
                </figure>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Number -->
                <div>
                    <x-label for="number">
                        <i class="fa-solid fa-list-ol mr-1"></i>
                        {{ __('Number') }}
                    </x-label>
                    <x-input id="number" class="block mt-1 w-full" type="number" wire:model="number"
                        :value="old('number', $number)" required autocomplete="number" placeholder="{{ __('Channel number') }}" />
                </div>

                <!-- OKTV Number -->
                <div>
                    <x-label for="number_oktv">
                        <i class="fa-solid fa-couch mr-1"></i>
                        {{ __('OKTV Number') }}
                    </x-label>
                    <x-input id="number_oktv" class="block mt-1 w-full" type="number" wire:model="number_oktv"
                        :value="old('number_oktv', $number_oktv)" required autocomplete="number_oktv"
                        placeholder="{{ __('Channel number on OKTV') }}" />
                </div>
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name">
                    <i class="fa-solid fa-tv mr-1"></i>
                    {{ __('Name') }}
                </x-label>
                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name', $name)"
                    required autocomplete="name" placeholder="{{ __('Channel name') }}" />
            </div>

            <!-- URL -->
            <div class="mt-4">
                <x-label for="url">
                    <i class="fa-solid fa-link mr-1"></i>
                    {{ __('URL') }}
                </x-label>
                <x-input id="url" class="block mt-1 w-full" type="text" wire:model="url" :value="old('url', $url)"
                    required autocomplete="url" placeholder="{{ __('Channel URL') }}" />
            </div>

            <!-- Status -->
            <div class="mt-4">
                <x-label for="status">
                    <i class="fa-solid fa-toggle-on mr-1"></i>
                    {{ __('Status') }}
                </x-label>
                <select id="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    wire:model="status" required>
                    <option value="" disabled>{{ __('Select status') }}</option>
                    <option value="Activo">{{ __('Active') }}</option>
                    <option value="Inactivo">{{ __('Inactive') }}</option>
                </select>
            </div>

            <!-- Submit -->
            <x-button class="w-full flex justify-center items-center mt-8">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                {{ __('Update channel') }}
            </x-button>
        </form>
    </div>
</div>
