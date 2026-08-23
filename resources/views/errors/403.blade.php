<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Akses Ditolak</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg p-10 text-center max-w-md">

        <div class="text-6xl font-bold text-red-500 mb-4">
            403
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Akses Ditolak
        </h1>

        <p class="text-gray-500 mb-6">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman atau melakukan tindakan ini.
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block px-20 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">
             Kembali ke Dashboard 
        </a>

    </div>

</body>

</html>