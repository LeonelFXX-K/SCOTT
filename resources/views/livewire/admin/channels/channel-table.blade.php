<div class="bg-white dark:bg-gray-800 relative shadow-2xl sm:rounded-lg overflow-hidden">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live="search" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Search') }}" required="" autofocus>
                </div>
            </form>
        </div>
        <div
            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <i class="fa-solid fa-filter mr-1.5"></i>
                    {{ __('Filter') }}
                    <i class="fa-solid fa-chevron-down ml-1.5"></i>
                </button>
                <div id="filterDropdown" class="z-10 hidden w-64 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <x-checkbox id="inactive-filter" wire:model.live="showInactive"></x-checkbox>
                    <label for="inactive-filter" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Show only inactive channels') }}
                    </label>
                </div>
            </div>
            <a href="{{ route('admin.channels.create') }}"
                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 shadow-xl">
                <i class="fa-solid fa-plus mr-1"></i>
                {{ __('Register new channel') }}
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-primary-600 shadow-2xl">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-image mr-1">
                        </i> {{ __('Image') }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-tv mr-1"></i>
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-list-ol mr-1"></i>
                        {{ __('Number') }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-couch mr-1"></i>
                        {{ __('OKTV') }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-toggle-on mr-1"></i>
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <i class="fa-solid fa-sliders-h mr-1"></i>
                        {{ __('Options') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($channels as $channel)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-900">
                        <td class="px-4 py-3">
                            <img src="{{ $channel->image_url ? asset('storage/' . $channel->image_url) : asset('img/no-image.png') }}"
                                alt="{{ $channel->name }}" class="w-10 h-10 object-center object-contain">
                        </td>
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $channel->name }}
                        </th>
                        <td class="px-4 py-3">
                            {{ $channel->number }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $channel->number_oktv }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($channel->status === 'Activo')
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
                        <td class="px-4 py-3 flex items-center">
                            <!-- Watch -->
                            <a href="#" title="{{ __('Watch channel') }}"
                                onclick="event.preventDefault(); openMiniPlayer('{{ $channel->url }}');"
                                class="flex justify-center items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <i
                                    class="fa-solid
                                    fa-arrow-up-right-from-square mr-1.5"></i>
                                {{ __('Watch') }}
                            </a>
                            <!-- Show -->
                            <a href="" title="{{ __('Show channel information') }}"
                                class="flex justify-center items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                <i class="fa-solid fa-eye mr-1.5"></i>
                                {{ __('Show') }}
                            </a>
                            <!-- Edit -->
                            <a href="" title="{{ __('Edit channel') }}"
                                class="flex justify-center items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fa-solid fa-pen-to-square mr-1.5"></i>
                                {{ __('Edit') }}
                            </a>
                            <!-- Delete -->
                            <form action="" method="POST" id="delete-form-{{ $channel->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $channel->id }})"
                                    title="{{ __('Delete channel') }}"
                                    class="flex justify-center items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                    <i class="fa-solid fa-trash-can mr-1.5"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center">{{ __('No channels found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $channels->links() }}
    </div>
</div>

@push('js')
    <script>
        function confirmDelete(channelID) {
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
                    document.getElementById('delete-form-' + channelID).submit();
                }
            });
        }
    </script>
@endpush

<script>
    function openMiniPlayer(url) {
        const youtubeRegex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/;
        const match = url.match(youtubeRegex);

        if (match) {
            const videoId = match[1];
            url = `https://www.youtube.com/embed/${videoId}`;
        }

        let playerContainer = document.getElementById('miniPlayerContainer');
        if (!playerContainer) {
            playerContainer = document.createElement('div');
            playerContainer.id = 'miniPlayerContainer';
            playerContainer.classList =
                'fixed bottom-4 right-4 w-80 bg-white shadow-lg rounded-lg overflow-hidden z-50';
            document.body.appendChild(playerContainer);

            const controlBar = document.createElement('div');
            controlBar.classList =
                'w-full flex justify-between items-center bg-primary-600 dark:bg-primary-700 text-white p-2 shadow-2xl';
            controlBar.style.height = '40px';
            controlBar.innerHTML = `
                <span>{{ __('Playing channel') }}</span>
                <button onclick="closeMiniPlayer()" class="text-gray-300 hover:text-white">
                    <i class="fa-solid fa-times"></i>
                </button>
            `;
            playerContainer.appendChild(controlBar);

            const iframe = document.createElement('iframe');
            iframe.classList = 'w-full';
            iframe.style.height =
                'calc(100% - 40px)';
            iframe.frameBorder = 0;
            iframe.allowFullscreen = true;
            playerContainer.appendChild(iframe);
        }

        playerContainer.querySelector('iframe').src = url;
        playerContainer.style.display = 'block';
    }

    function closeMiniPlayer() {
        const playerContainer = document.getElementById('miniPlayerContainer');
        if (playerContainer) {
            playerContainer.style.display = 'none';
            playerContainer.querySelector('iframe').src = '';
        }
    }
</script>
