<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- BREADCRUMB --}}
    <x-slot name="breadcrumb">

        <x-ui.breadcrumb
            :items="[
                [
                    'label' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
            ]" />

    </x-slot>


    {{-- STAT CARDS --}}
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <x-ui.stat-card
                    value="{{ \App\Models\Book::count() }}"
                    label="Total Buku"
                    icon="📚"
                    trend="+10%" />

                <x-ui.stat-card
                    value="{{ \App\Models\User::count() }}"
                    label="Total Pengguna"
                    icon="👥"
                    trend="+5%" />

                <x-ui.stat-card
                    value="3"
                    label="Kategori Buku"
                    icon="📂"
                    trend="+2%" />

            </div>

        </div>

    </div>

</x-app-layout>