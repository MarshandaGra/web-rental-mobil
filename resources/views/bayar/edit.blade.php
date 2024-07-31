<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jenis Pembayaran') }}
        </h2>
    </x-slot>

    <div class="row mt-3 ml-2">
        <div class="col-5">
            <!-- Header dengan warna biru -->
            <div class="mb-3">
                <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
            </div>
            <!-- Form dengan shadow -->
            <form method="POST" action="{{ route('bayar.update', $bayar->id) }}"
                class="shadow p-3 mb-5 bg-white rounded">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jenis_bayar" class="form-label">Jenis Pembayaran</label>
                    <input type="text" name="jenis_bayar" class="form-control @error('jenis_bayar') is-invalid @enderror"
                        id="jenis_bayar" value="{{ old('jenis_bayar', $bayar->jenis_bayar) }}">
                    @error('jenis_bayar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('bayar.index') }}" class="btn btn-warning ml-3">Kembali</a>
            </form>

        </div>
</x-app-layout>