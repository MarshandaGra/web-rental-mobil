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
                                <th>Tanggal Kembali Terjadwal</th>
                                <th>Kembali Sebenarnya</th>
                                <th>Keterlambatan (hari)</th>
                                <th>Total Harga</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->mobil ? $data->mobil->nama_m : 'Mobil tidak tersedia' }}</td>
                                    <td>{{ $data->pemesan ? $data->pemesan->nama_pemesan : 'Pemesan tidak tersedia' }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>{{ $data->kembali_sebenarnya ? \Carbon\Carbon::parse($data->kembali_sebenarnya)->format('d M Y') : 'Belum Dikembalikan' }}
                                    </td>
                                    <td>
                                        @if ($data->kembali_sebenarnya)
                                            {{ $data->keterlambatan_hari > 0 ? $data->keterlambatan_hari : '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($data->harga_total, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($data->denda > 0)
                                            Rp {{ number_format($data->denda, 2, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </main>
        </div>
    </div>
</x-app-layout>
