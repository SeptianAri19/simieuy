@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Permintaan Peminjaman</h2>
            <p class="text-gray-500">Kelola permintaan peminjaman inventaris: setujui atau tolak.</p>
        </div>

        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg"
        >
            + Tambah Permintaan
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
                    <th class="py-3">Nama Peminjam</th>
                    <th class="py-3">Organisasi</th>
                    <th class="py-3">Inventaris</th>
                    <th class="py-3">Durasi Pinjam</th>
                    <th class="py-3">Surat</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loanRequests as $index => $requestItem)
                    <tr class="border-b">
                        <td class="py-3">{{ $index + 1 }}</td>
                        <td class="py-3">{{ $requestItem->borrower_name }}</td>
                        <td class="py-3">{{ $requestItem->organization ?? '-' }}</td>
                        <td class="py-3">{{ $requestItem->inventory->name ?? '-' }}</td>
                        <td class="py-3">{{ $requestItem->duration_days }} hari</td>
                        <td class="py-3">
                            @if ($requestItem->surat_link)
                                <a href="{{ $requestItem->surat_link }}" target="_blank" class="text-blue-600 hover:underline">
                                    Buka Surat
                                </a>
                            @else
                                <span class="text-gray-400">Tidak ada</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if ($requestItem->status === 'pending')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    Menunggu Persetujuan
                                </span>
                            @elseif ($requestItem->status === 'approved')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    Disetujui
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="flex items-center justify-center gap-2">
                                @if ($requestItem->status === 'pending')
                                    <form action="{{ route('loan-requests.approve', $requestItem->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('loan-requests.reject', $requestItem->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                            Tolak
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">Sudah diproses</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-6 text-center text-gray-500">
                            Belum ada permintaan peminjaman.
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
            <h3 class="text-2xl font-bold">Tambah Permintaan Peminjaman</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-500 text-xl">
                &times;
            </button>
        </div>

        <form action="{{ route('loan-requests.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Nama Peminjam</label>
                <input type="text" name="borrower_name" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Organisasi</label>
                <input type="text" name="organization" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Inventaris Dipinjam</label>
                <select name="inventory_id" class="w-full border rounded-lg px-4 py-2" required>
                    <option value="">-- Pilih Inventaris --</option>
                    @foreach ($inventories as $inventory)
                        <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Durasi Pinjam (hari)</label>
                <input type="number" name="duration_days" min="1" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Link Surat</label>
                <input type="url" name="surat_link" class="w-full border rounded-lg px-4 py-2" placeholder="https://...">
                <small class="text-gray-500">Opsional.</small>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 rounded-lg border">
                    Batal
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection