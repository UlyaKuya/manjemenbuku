@props([
'variant' => 'primary',
'size' => 'md',
'loading' => false,
])

@php
$variants = [
'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
'secondary' => 'bg-gray-100 text-gray-700 hover:bg-gray-200',
'danger' => 'bg-red-600 text-white hover:bg-red-700',
'ghost' => 'bg-transparent text-gray-600 hover:bg-gray-100',
];

$sizes = [
'sm' => 'px-3 py-1.5 text-xs',
'md' => 'px-4 py-2 text-sm',
'lg' => 'px-5 py-2.5 text-base',
];
@endphp

<button
    type="button"
    {{ $attributes->class([
        'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition',
        'disabled:opacity-50 disabled:cursor-not-allowed',
        $variants[$variant] ?? $variants['primary'],
        $sizes[$size] ?? $sizes['md'],
    ]) }}
    @disabled($loading)>
    @if($loading)
    <span>Loading...</span>
    @else
    {{ $slot }}
    @endif
</button>