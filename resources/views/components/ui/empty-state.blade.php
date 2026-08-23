@props([
'icon' => '📋',
'title' => 'Tidak ada data',
'subtitle' => '',
])

<div class="flex flex-col items-center justify-center py-12 text-center">

    <div class="text-5xl mb-4">
        {{ $icon }}
    </div>

    <h3 class="text-lg font-semibold text-gray-800">
        {{ $title }}
    </h3>

    @if($subtitle)
    <p class="mt-1 text-sm text-gray-500">
        {{ $subtitle }}
    </p>
    @endif

    @if(isset($action))
    <div class="mt-5">
        {{ $action }}
    </div>
    @endif

</div>