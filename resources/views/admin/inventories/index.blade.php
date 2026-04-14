@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Data Inventaris</h2>
            <p class="text-gray-500">Kelola data inventaris: tambah, update, dan hapus.</p>
        </div>

        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg"
        >
            + Tambah Inventaris
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b text-gray-700">
                    <th class="py-3">No</th>
                    <th class="py-3">Nama Inventaris</th>
                    <th class="py-3">Gambar</th>
                    <th class="py-3">Kategori</th>
                    <th class="py-3">Total Stok</th>
                    <th class="py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inventories as $index => $inventory)
                    <tr class="border-b">
                        <td class="py-3">{{ $index + 1 }}</td>
                        <td class="py-3">{{ $inventory->name }}</td>
                        <td class="py-3">
                            @if ($inventory->image)
                                <img
                                    src="{{ asset('storage/' . $inventory->image) }}"
                                    alt="{{ $inventory->name }}"
                                    class="w-16 h-16 object-cover rounded-lg border"
                                >
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $inventory->category }}</td>
                        <td class="py-3">{{ $inventory->total_stock }}</td>
                        <td class="py-3">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    onclick="openEditModal(
                                        {{ $inventory->id }},
                                        '{{ addslashes($inventory->name) }}',
                                        '{{ addslashes($inventory->category) }}',
                                        {{ $inventory->total_stock }},
                                        `{{ addslashes($inventory->description ?? '') }}`
                                    )"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg"
                                >
                                    Edit
                                </button>

                                <form
                                    action="{{ route('inventories.destroy', $inventory->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus inventaris ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-6 text-center text-gray-500">
                            Belum ada data inventaris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold">Tambah Inventaris</h3>
            <button
                onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-gray-500 text-xl"
            >
                &times;
            </button>
        </div>

        <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Nama Inventaris</label>
                <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kategori</label>
                <input type="text" name="category" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Total Stok</label>
                <input type="number" name="total_stock" min="1" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium">Gambar Inventaris</label>
                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="w-full border rounded-lg px-4 py-2"
                >
                <small class="text-gray-500">Format: jpg, jpeg, png, webp. Maksimal 5 MB.</small>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="px-4 py-2 rounded-lg border"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold">Update Inventaris</h3>
            <button
                onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="text-gray-500 text-xl"
            >
                &times;
            </button>
        </div>

        <form id="formEdit" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">Nama Inventaris</label>
                <input type="text" id="edit_name" name="name" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kategori</label>
                <input type="text" id="edit_category" name="category" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Total Stok</label>
                <input type="number" id="edit_total_stock" name="total_stock" min="1" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea id="edit_description" name="description" rows="3" class="w-full border rounded-lg px-4 py-2"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium">Ganti Gambar Inventaris</label>
                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="w-full border rounded-lg px-4 py-2"
                >
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar. Maksimal 5 MB.</small>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 rounded-lg border"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, category, totalStock, description) {
        document.getElementById('formEdit').action = `/inventories/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_total_stock').value = totalStock;
        document.getElementById('edit_description').value = description;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endsection