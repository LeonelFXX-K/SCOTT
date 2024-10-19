<x-guest-layout>
    <section class="h-screen">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <x-logotipo></x-logotipo>

            <div
                class="w-full bg-white rounded-lg shadow-2xl dark:border md:mt-0 sm:max-w-4xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('Register your details for your account') }}
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ __("Already have an account?") }}
                            <a href="{{ route('login') }}"
                                class="ms-1 font-medium text-primary-500 underline hover:text-primary-600">
                                {{ __('Sign In') }}
                            </a>
                        </p>
                    </h1>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ $value }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <x-label for="name">
                                <i class="fa-solid fa-user mr-1"></i>
                                {{ __('Name') }}
                            </x-label>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name"
                                placeholder="ej. Edgar Leonel Acevedo Cuevas" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email">
                                <i class="fa-solid fa-envelope mr-1"></i>
                                {{ __('Email') }}
                            </x-label>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username"
                                placeholder="nombre@stargroup.com.mx" />
                        </div>

                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <div>
                                <x-label for="password">
                                    <i class="fa-solid fa-key mr-1"></i>
                                    {{ __('Password') }}
                                </x-label>
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="new-password" placeholder="••••••••" />
                            </div>

                            <div>
                                <x-label for="password_confirmation">
                                    <i class="fa-solid fa-key mr-1"></i>
                                    {{ __('Confirm Password') }}
                                </x-label>
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="••••••••" />
                            </div>
                        </div>

                        <x-button class="w-full mt-8 flex items-center justify-center">
                            {{ __('Sign Up') }}
                            <i class="fa-solid fa-right-to-bracket ml-2"></i>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
