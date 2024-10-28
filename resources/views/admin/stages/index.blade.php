<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'icon' => 'fa-solid fa-house',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => __('Stages'),
        'icon' => 'fa-solid fa-bars-staggered',
    ],
]">

    @if ($stages->count())

        <x-slot name="action">
            <a href="{{ route('admin.stages.create') }}"
                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 shadow-xl">
                <i class="fa-solid fa-plus mr-1"></i>
                {{ __('Register new stage') }}
            </a>
        </x-slot>

        <div class="bg-white dark:bg-gray-800 relative shadow-2xl sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs dark:text-white uppercase dark:bg-gray-600 shadow-2xl">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                <i class="fa-solid fa-bars-staggered mr-1"></i>
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <i class="fa-solid fa-toggle-on mr-1"></i>
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">
                                    <i class="fa-solid fa-sliders-h mr-1"></i>
                                    {{ __('Options') }}
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stages as $stage)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 text-black dark:text-white">
                                <th scope="row"
                                    class="px-4 py-2.5 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $stage->name }}
                                </th>
                                <td class="px-4 py-2.5">
                                    @if ($stage->status === 'Activo')
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-200 rounded-full dark:bg-green-800 dark:text-green-200">
                                            <i class="fa-solid fa-check-circle mr-1"></i>
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-800 bg-red-200 rounded-full dark:bg-red-800 dark:text-red-200">
                                            <i class="fa-solid fa-times-circle mr-1"></i>
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2.5 flex items-center justify-center">
                                    <button id="stage-dropdown-button-{{ $stage->id }}"
                                        data-dropdown-toggle="stage-dropdown-{{ $stage->id }}"
                                        class="inline-flex items-center p-3 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>

                                    <div id="stage-dropdown-{{ $stage->id }}"
                                        class="hidden z-50 w-44 bg-white rounded divide-y divide-gray-300 shadow-2xl dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="flex flex-col items-start py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="stage-dropdown-button-{{ $stage->id }}">
                                            <!-- Show -->
                                            <li class="w-full">
                                                <a href="{{ route('admin.stages.show', $stage) }}"
                                                    title="{{ __('Show stage information') }}"
                                                    class="flex items-center w-full py-2 px-3.5 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <i class="fa-solid fa-eye mr-2"></i> {{ __('Show') }}
                                                </a>
                                            </li>
                                            <!-- Edit -->
                                            <li class="w-full">
                                                <a href="{{ route('admin.stages.edit', $stage) }}"
                                                    title="{{ __('Edit stage') }}"
                                                    class="flex items-center w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <i class="fa-solid fa-pen-to-square mr-2"></i> {{ __('Edit') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Delete -->
                                        <div class="w-full py-1">
                                            <form action="{{ route('admin.stages.destroy', $stage) }}" method="POST"
                                                id="delete-form-{{ $stage->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $stage->id }})"
                                                    title="{{ __('Delete stage') }}"
                                                    class="flex items-center w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    <i class="fa-solid fa-trash-can mr-2"></i> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="flex items-center justify-between p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 shadow-xl"
            role="alert">
            <div class="inline-flex">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ __('This is an information alert!') }}</span>
                    {{ __('There are no stages registered in the database.') }}
                </div>
            </div>
            <div>
                <a href="{{ route('admin.stages.create') }}"
                    class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 shadow-xl">
                    <i class="fa-solid fa-plus mr-1"></i>
                    {{ __('Register new stage') }}
                </a>
            </div>
        </div>
    @endif

    @push('js')
        <script>
            function confirmDelete(stageID) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You wont be able to revert this!') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + stageID).submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
