@props([
'value' => '0',
'label' => 'Statistik',
'icon' => '📊',
'trend' => null,
'trendUp' => true,
])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">

    <div class="flex items-start justify-between">

        {{-- Icon --}}
        <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-indigo-50 text-2xl">
            {{ $icon }}
        </div>

        {{-- Trend --}}
        @if($trend)
        <span
            class="text-sm font-medium
                {{ $trendUp ? 'text-green-600' : 'text-red-600' }}">

            {{ $trendUp ? '↑' : '↓' }}
            {{ $trend }}

        </span>
        @endif

    </div>

    {{-- Value --}}
    <div class="mt-4">

        <div class="text-3xl font-bold text-gray-800">
            {{ $value }}
        </div>

        <div class="mt-1 text-sm text-gray-500">
            {{ $label }}
        </div>

    </div>

</div>