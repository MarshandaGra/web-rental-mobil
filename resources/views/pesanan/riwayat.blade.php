<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60">
            {{ __('Data Pengembalian') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <div class="mb-1">
                    <h4 class="bg-secondary text-white p-2 rounded">Data Pengembalian</h4>
                </div>
                <div class="row mb-1 mt-1">
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mobil</th>
                                <th>Pemesan</th>
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
                                    <td>{{ $data->mobil ? $data->mobil->nama_m : 'mobil tidak tersesia' }}</td>
                                    <td>{{ $data->pemesan ? $data->pemesan->nama_pemesan : 'pemesan tidak tersedia' }}
                                    </td>
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
