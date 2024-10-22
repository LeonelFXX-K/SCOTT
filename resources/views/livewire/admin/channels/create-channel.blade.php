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
            </p>
        </h1>

        <!-- Form -->
        <form wire:submit.prevent="store">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Number -->
                        <div>
                            <x-label for="number">
                                <i class="fa-solid fa-hashtag mr-1"></i>
                                {{ __('Number') }}
                            </x-label>
                            <x-input id="number" class="block mt-1 w-full" type="number" wire:model="number"
                                :value="old('number')" required autofocus autocomplete="number"
                                placeholder="{{ __('Channel number') }}" />
                        </div>

                        <!-- OKTV Number -->
                        <div>
                            <x-label for="number_oktv">
                                <i class="fa-solid fa-hashtag mr-1"></i>
                                {{ __('OKTV Number') }}
                            </x-label>
                            <x-input id="number_oktv" class="block mt-1 w-full" type="number" wire:model="number_oktv"
                                :value="old('number_oktv')" required autocomplete="number_oktv"
                                placeholder="{{ __('Channel number on OKTV') }}" />
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mt-4">
                        <x-label for="name">
                            <i class="fa-solid fa-file-signature mr-1"></i>
                            {{ __('Name') }}
                        </x-label>
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                            :value="old('name')" required autocomplete="name" placeholder="{{ __('Channel name') }}" />
                    </div>

                    <!-- URL -->
                    <div class="mt-4">
                        <x-label for="url">
                            <i class="fa-solid fa-link mr-1"></i>
                            {{ __('URL') }}
                        </x-label>
                        <x-input id="url" class="block mt-1 w-full" type="text" wire:model="url"
                            :value="old('url')" required autocomplete="url" placeholder="{{ __('Channel URL') }}" />
                    </div>
                </div>

                <div class="mt-4 md:mt-0">
                    <figure class="mb-4 relative">
                        <div class="absolute right-0 p-4">
                            <label
                                class="flex items-center px-4 py-2 rounded-lg bg-primary-600 cursor-pointer text-white">
                                {{ __('Update image') }}
                                <i class="fas fa-camera ml-2"></i>
                                <input type="file" class="hidden" accept="image/*" wire:model="image_url">
                            </label>
                        </div>
                        <img class="aspect-[16/9] object-cover object-center w-full rounded-lg"
                            src="{{ $image_url ? $image_url->temporaryUrl() : asset('img/no-image.png') }}"
                            alt="">
                    </figure>
                </div>
            </div>

            <!-- Submit -->
            <x-button class="w-full flex justify-center items-center mt-4">
                {{ __('Register new channel') }}
                <i class="fa-solid fa-floppy-disk ml-2"></i>
            </x-button>
        </form>
    </div>
</div>
