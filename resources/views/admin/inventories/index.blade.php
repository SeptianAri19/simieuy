@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                Data Inventaris
            </h1>

            <p class="text-gray-500 text-sm">
                Kelola seluruh inventaris yang tersedia
            </p>
        </div>

        <button onclick="openModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
            + Tambah Inventaris
        </button>

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="text-left text-gray-500 border-b">

                        <th class="pb-3">Nama</th>
                        <th class="pb-3">Kategori</th>
                        <th class="pb-3">Total</th>
                        <th class="pb-3">Tersedia</th>
                        <th class="pb-3">Aksi</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($inventories as $inventory)

                    <tr>

                        <td class="py-3 font-medium">
                            {{ $inventory->name }}
                        </td>

                        <td>
                            {{ $inventory->category }}
                        </td>

                        <td>
                            {{ $inventory->total_stock }}
                        </td>

                        <td>
                            {{ $inventory->available_stock }}
                        </td>

                        <td class="space-x-3">

                            <button onclick="openEditModal({{ $inventory->id }}, '{{ $inventory->name }}', '{{ $inventory->category }}', {{ $inventory->total_stock }}, '{{ $inventory->description }}')"
                                class="text-blue-600 text-sm">
                                Edit
                            </button>


                            <form action="{{ route('inventories.destroy',$inventory->id) }}" method="POST" class="inline">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus data ini?')" class="text-red-600 text-sm">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">
                            Belum ada data inventaris
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- MODAL TAMBAH --}}

<div id="inventoryModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-xl p-6">

        <h2 class="text-lg font-semibold mb-4">
            Tambah Inventaris
        </h2>

        <form action="{{ route('inventories.store') }}" method="POST">

            @csrf

            <div class="space-y-4">

                <input type="text" name="name" placeholder="Nama Inventaris"
                    class="w-full border rounded-lg p-2">

                <input type="text" name="category" placeholder="Kategori"
                    class="w-full border rounded-lg p-2">

                <input type="number" name="total_stock" placeholder="Jumlah Stok"
                    class="w-full border rounded-lg p-2">

                <textarea name="description" placeholder="Deskripsi"
                    class="w-full border rounded-lg p-2"></textarea>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 border rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>


{{-- MODAL EDIT --}}

<div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-xl p-6">

        <h2 class="text-lg font-semibold mb-4">
            Edit Inventaris
        </h2>

        <form id="editForm" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <input id="editName" type="text" name="name"
                    class="w-full border rounded-lg p-2">

                <input id="editCategory" type="text" name="category"
                    class="w-full border rounded-lg p-2">

                <input id="editStock" type="number" name="total_stock"
                    class="w-full border rounded-lg p-2">

                <textarea id="editDescription" name="description"
                    class="w-full border rounded-lg p-2"></textarea>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2 border rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>


<script>

function openModal() {
    document.getElementById('inventoryModal').classList.remove('hidden');
    document.getElementById('inventoryModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('inventoryModal').classList.add('hidden');
}

function openEditModal(id, name, category, stock, description) {

    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');

    document.getElementById('editName').value = name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editStock').value = stock;
    document.getElementById('editDescription').value = description;

    document.getElementById('editForm').action = '/inventories/' + id;

}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

</script>

@endsection