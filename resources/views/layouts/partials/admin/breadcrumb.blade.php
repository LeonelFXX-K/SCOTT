@if (count($breadcrumbs))
    <nav class="mb-4">
        <ol class="flex flex-wrap">
            @foreach ($breadcrumbs as $item)
                <li
                    class="text-sm leading-normal text-gray-700 dark:text-gray-400 {{ !$loop->first ? "pl-2 before:float-left before:pr-2 before:content-['/']" : '' }}">
                    @isset($item['route'])
                        <a href="{{ $item['route'] }}" class="hover:underline font-semibold text-gray-950 dark:text-gray-200">
                            {{ $item['name'] }}
                        </a>
                    @else
                        {{ $item['name'] }}
                    @endisset
                </li>
            @endforeach
        </ol>
        @if (count($breadcrumbs) > 1)
            <h6 class="ml-4 font-bold dark:text-gray-200">
                {{ end($breadcrumbs)['name'] }}
            </h6>
        @endif
    </nav>
@endif