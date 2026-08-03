<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - UAS Proyek Akhir</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-6xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- KIRI --}}
            <div class="p-10 lg:p-16 flex flex-col justify-center">

                <span class="text-blue-600 font-semibold uppercase tracking-wider">
                    UAS Pemrograman Web 2
                </span>

                <h1 class="text-4xl font-bold text-gray-800 mt-3">
                    Manajemen Buku
                </h1>

                <p class="text-gray-500 mt-3">
                    Sistem Informasi Manajemen Buku Laravel untuk membantu
                    administrasi buku secara digital.
                </p>

                <div class="mt-10 space-y-3">

                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold">Nama</span>
                        <span>Ulya Panwasusana</span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold">NRP</span>
                        <span>241226004</span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold">Mata Kuliah</span>
                        <span>Pemrograman Web 2</span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold">Universitas</span>
                        <span>UBHINUS Malang</span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold">Tahun</span>
                        <span>2026</span>
                    </div>

                </div>

                <div class="mt-10 flex gap-4">

                    @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Login
                    </a>

                    @if(Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                        Register
                    </a>
                    @endif
                    @endauth

                </div>

            </div>

            {{-- KANAN --}}
            <div class="bg-gradient-to-br from-white-600 to-indigo-700 flex items-center justify-center p-10">

                <img src="{{ asset('welcome/logo.png') }}"
                    alt="Logo KendedesGo"
                    class="max-w-sm w-full h-auto drop-shadow-2xl">

            </div>

        </div>

    </div>

</body>

</html>