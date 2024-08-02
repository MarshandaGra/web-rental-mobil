<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Mobil') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <h1 class="h3">Data Pengembalian</h1>
                <ul class="list-group mt-3">
                    <li class="list-group-item list-group-item-dark text-secondary">Data Pengembalian Mobil</li>
                </ul>
                <div class="row mb-3">

                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemesan</th>
                                <th>Mobil</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Total Harga</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->mobil->nama_m }}</td>
                                    <td>{{ $data->pemesan->nama_pemesan }}</td>
                                    <td>{{ $data->tanggal_mulai }}</td>
                                    <td>{{ $data->tanggal_kembali }}</td>
                                    <td>Rp{{ number_format($data->harga_total, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($data->denda, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
