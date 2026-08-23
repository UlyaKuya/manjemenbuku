<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        {{-- NAVBAR --}}
        @include('layouts.navigation')


        {{-- HEADER --}}
        @isset($header)

        <header class="bg-white shadow">

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                {{ $header }}

            </div>

        </header>

        @endisset


        {{-- MAIN --}}
        <main>

            @isset($breadcrumb)

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                {{ $breadcrumb }}
            </div>

            @endisset

            <livewire:global-search />

            {{ $slot }}

        </main>

    </div>

    @livewireScripts

</body>

</html>