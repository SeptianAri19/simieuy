<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMI</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="flex-1 min-h-screen">

        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Content --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>