<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Mobil') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <p class="h3">Detail Mobil</p>
                <ul class="list-group mt-3">
                    <li class="list-group-item list-group-item-dark text-secondary color-blue">Detail Mobil</li>
                </ul>

                <div class="row mt-4">
                    <div class="card">
                        <div class="card-header">
                            Detail Mobil - {{ $mobil->nama_m }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    @if ($mobil->gambar)
                                        <img src="{{ Storage::url('images/' . $mobil->gambar) }}" alt="Gambar Mobil"
                                            class="img-fluid" style="max-width: 100%; height: 300px;">
                                    @else
                                        <p>Tidak ada gambar</p>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <p><strong>Nama :</strong> {{ $mobil->nama_m }}</p>
                                    <p><strong>Merk :</strong> {{ $mobil->merk->nama_merk }}</p>
                                    <p><strong>Kursi :</strong> {{ $mobil->kursi }}</p>
                                    <p><strong>No Polisi :</strong> {{ $mobil->nomor_polisi }}</p>
                                    <p><strong>Tahun :</strong> {{ $mobil->tahun }}</p>
                                    <p><strong>Harga per Hari: Rp.</strong>
                                        {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('mobils.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
