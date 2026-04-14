<aside class="w-72 bg-red-700 min-h-screen text-white p-6">
    <h1 class="text-3xl font-bold mb-10">Inventory System</h1>

    <nav class="space-y-6 text-xl">
        <a href="{{ route('dashboard') }}"
           class="block hover:underline {{ request()->routeIs('dashboard') ? 'font-bold' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('inventories.index') }}"
           class="block hover:underline {{ request()->routeIs('inventories.*') ? 'font-bold' : '' }}">
            Data Inventaris
        </a>

        <a href="#"
           class="block hover:underline">
            Permintaan Peminjaman
        </a>

        <a href="#"
           class="block hover:underline">
            Pengembalian Inventaris
        </a>
    </nav>
</aside>