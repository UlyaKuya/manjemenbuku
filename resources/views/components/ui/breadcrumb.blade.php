@props([
    'items' => [],
])

<nav class="mb-6" aria-label="Breadcrumb">

    <ol class="flex items-center gap-2 text-sm text-gray-500">

        @foreach($items as $index => $item)

            @if($index > 0)
                <li class="text-gray-400">
                    /
                </li>
            @endif

            <li>

                @if(isset($item['url']) && $index < count($items) - 1)

                    <a
                        href="{{ $item['url'] }}"
                        class="hover:text-indigo-600 transition">
                        {{ $item['label'] }}
                    </a>

                @else

                    <span class="font-medium text-gray-800">
                        {{ $item['label'] }}
                    </span>

                @endif

            </li>

        @endforeach

    </ol>

</nav>
