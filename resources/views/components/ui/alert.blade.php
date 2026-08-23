@props([
'variant' => 'success',
])

@php
$variants = [
'success' => [
'class' => 'bg-green-100 border-green-300 text-green-700',
'icon' => '✓',
],

'error' => [
'class' => 'bg-red-100 border-red-300 text-red-700',
'icon' => '✕',
],

'warning' => [
'class' => 'bg-yellow-100 border-yellow-300 text-yellow-700',
'icon' => '⚠',
],
];

$style = $variants[$variant] ?? $variants['success'];
@endphp

<div
    {{ $attributes->merge([
        'class' => 'border rounded-lg px-4 py-3 flex items-center gap-3 ' . $style['class']
    ]) }}>

    <span class="font-bold">
        {{ $style['icon'] }}
    </span>

    <div>
        {{ $slot }}
    </div>

</div>