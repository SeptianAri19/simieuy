<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Inventory System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1">
            <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Sistem Manajemen Peminjaman Inventaris</h1>
                <div class="text-lg">
                    {{ Auth::user()->name ?? 'User' }}
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>