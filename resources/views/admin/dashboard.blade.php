@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Title --}}
    <div>
        <h1 class="text-2xl font-bold">
            Dashboard
        </h1>

        <p class="text-gray-500">
            Ringkasan sistem peminjaman inventaris
        </p>
    </div>


    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total Inventaris --}}
        <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">
                    Total Inventaris
                </p>

                <h2 class="text-3xl font-bold">
                    48
                </h2>
            </div>

            <div class="bg-red-600 text-white p-3 rounded-lg">
                📦
            </div>

        </div>


        {{-- Peminjaman Aktif --}}
        <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">
                    Peminjaman Aktif
                </p>

                <h2 class="text-3xl font-bold">
                    12
                </h2>
            </div>

            <div class="bg-yellow-500 text-white p-3 rounded-lg">
                📄
            </div>

        </div>


        {{-- Menunggu Persetujuan --}}
        <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">

            <div>
                <p class="text-gray-500 text-sm">
                    Menunggu Persetujuan
                </p>

                <h2 class="text-3xl font-bold">
                    5
                </h2>
            </div>

            <div class="bg-red-500 text-white p-3 rounded-lg">
                ⏱
            </div>

        </div>

    </div>


    {{-- Permintaan Peminjaman Terbaru --}}
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-lg font-semibold">
                Permintaan Peminjaman Terbaru
            </h2>

            <a href="#" class="text-red-600 text-sm font-medium">
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="text-left text-gray-500 border-b">

                        <th class="pb-3">Nama Peminjam</th>
                        <th class="pb-3">Organisasi</th>
                        <th class="pb-3">Inventaris</th>
                        <th class="pb-3">Jumlah</th>
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Aksi</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    <tr>

                        <td class="py-3">Ahmad Ridwan</td>
                        <td>Himpunan Mahasiswa</td>
                        <td>Proyektor Epson EB-X05</td>
                        <td>2</td>
                        <td>2026-03-09</td>

                        <td>
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                                Menunggu Persetujuan
                            </span>
                        </td>

                        <td>
                            <button class="text-red-600 text-sm">
                                Detail
                            </button>
                        </td>

                    </tr>


                    <tr>

                        <td class="py-3">Siti Nurhaliza</td>
                        <td>BEM Fakultas</td>
                        <td>Kursi Lipat</td>
                        <td>50</td>
                        <td>2026-03-08</td>

                        <td>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                Disetujui
                            </span>
                        </td>

                        <td>
                            <button class="text-red-600 text-sm">
                                Detail
                            </button>
                        </td>

                    </tr>


                    <tr>

                        <td class="py-3">Budi Santoso</td>
                        <td>UKM Seni</td>
                        <td>Sound System</td>
                        <td>1</td>
                        <td>2026-03-08</td>

                        <td>
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                                Menunggu Persetujuan
                            </span>
                        </td>

                        <td>
                            <button class="text-red-600 text-sm">
                                Detail
                            </button>
                        </td>

                    </tr>


                    <tr>

                        <td class="py-3">Dewi Lestari</td>
                        <td>Komunitas Fotografi</td>
                        <td>Kamera DSLR Canon</td>
                        <td>3</td>
                        <td>2026-03-07</td>

                        <td>
                            <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                                Ditolak
                            </span>
                        </td>

                        <td>
                            <button class="text-red-600 text-sm">
                                Detail
                            </button>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection