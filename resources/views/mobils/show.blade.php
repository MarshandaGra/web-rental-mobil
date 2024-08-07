<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60">
            {{ __('Detail Mobil - ') . $mobil->nama_m }}
        </h2>
    </x-slot>

    <div class="flex-1 ml-60 p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex">
                        <div class="p-2">
                            <img id="imagePreview" src="{{ asset('storage/public/images/mobils/' . $mobil->gambar) }}"
                                alt="Preview image"
                                style="display: {{ $mobil->gambar ? 'block' : 'none' }}; width: 200px;">
                        </div>
                        <div class="p-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama Mobil</td>
                                    <td>: {{ $mobil->nama_m }}</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>: {{ $mobil->merk->nama_merk }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Kursi</td>
                                    <td>: {{ $mobil->kursi }}</td>
                                </tr>
                                <tr>
                                    <td>No Polisi</td>
                                    <td>: {{ $mobil->nomor_polisi }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>: {{ $mobil->tahun }}</td>
                                </tr>
                                <tr>
                                    <td>Harga per Hari </td>
                                    <td>: <p style="display: inline">Rp.
                                            {{ number_format($mobil->harga_per_hari, 0, ',', '.') }} </p>
                                    </td>
                                </tr>
                            </table>
                            <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
