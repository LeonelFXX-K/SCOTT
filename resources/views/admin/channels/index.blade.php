<x-admin-layout :breadcrumbs="[
    [
        'name' => __('Dashboard'),
        'icon' => 'fa-solid fa-house',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => __('Channels'),
        'icon' => 'fa-solid fa-tv',
    ],
]">

    <x-slot name="action">
        <div class="flex justify-center items-center">
            <a href="{{ route('admin.channels.create') }}"
                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 shadow-xl">
                {{ __('Register new channel') }}
                <i class="fa-solid fa-plus ml-1"></i>
            </a>
        </div>
    </x-slot>

    @if ($channels->count())
        <div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-primary-600 dark:bg-primary-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <i class="fas fa-camera mr-1"></i>
                            {{ __('Image') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-file-signature mr-1"></i>
                            {{ __('Name') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-hashtag mr-1"></i>
                            {{ __('Number') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-book-open mr-1"></i>
                            {{ __('OKTV Number') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <i class="fa-solid fa-gear mr-1"></i>
                            {{ __('Options') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($channels as $channel)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                            <!-- Image -->
                            <td class="px-6 py-2">
                                <img src="{{ $channel->image_url ? asset('storage/public/' . $channel->image_url) : asset('img/no-image.png') }}"
                                    alt="{{ $channel->name }}" class="w-10 h-10 object-center object-contain">
                            </td>

                            <!-- Name -->
                            <td scope="row"
                                class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $channel->name }}
                            </td>

                            <!-- Number -->
                            <th class="px-6 py-2">
                                {{ $channel->number }}
                            </th>

                            <!-- OKTV Number -->
                            <td class="px-6 py-2">
                                {{ $channel->number_oktv }}
                            </td>

                            <!-- Options (Watch, Show, Edit, Delete) -->
                            <td class="px-6 py-2">
                                <div class="flex">
                                    <!-- Watch -->
                                    <a href="#" title="{{ __('Watch channel') }}"
                                        onclick="event.preventDefault(); openMiniPlayer('{{ $channel->url }}');"
                                        class="flex justify-center items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-primary-700 dark:hover:bg-primary-800 focus:outline-none dark:focus:ring-primary-800">
                                        <i
                                            class="fa-solid
                                    fa-arrow-up-right-from-square mr-1"></i>
                                        {{ __('Watch') }}
                                    </a>
                                    <!-- Show -->
                                    <a href="" title="{{ __('Show channel information') }}"
                                        class="flex justify-center items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-gray-700 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-800">
                                        <i class="fa-solid fa-eye mr-1"></i>
                                        {{ __('Show') }}
                                    </a>
                                    <!-- Edit -->
                                    <a href="" title="{{ __('Edit channel') }}"
                                        class="flex justify-center items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <!-- Delete -->
                                    <form action="" method="POST" id="delete-form-{{ $channel->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $channel->id }})"
                                            title="{{ __('Delete channel') }}"
                                            class="flex justify-center items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            <i class="fa-solid fa-trash-can mr-1"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $channels->links() }}
        </div>
    @else
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 shadow-xl"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ __('This is an information alert!') }}</span>
                {{ __('There are no channels registered in the database.') }}
            </div>
        </div>
    @endif

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

</x-admin-layout>

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
