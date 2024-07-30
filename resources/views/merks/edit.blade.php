<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Merk') }}
        </h2>
    </x-slot>
    <div class="container-fluid ">
        <p class="h3">Form Edit Merk</p>
    </div>

    <div class="row mt-4">
        <div class="col-5">
            <!-- Header dengan warna biru -->
            <div class="mb-3">
                <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
            </div>
            <!-- Form dengan shadow -->
            <form method="POST" action="{{ route('merks.update', $merk->id) }}"
                class="shadow p-3 mb-5 bg-white rounded">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="merk" class="form-label">Nama Merk</label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror"
                        id="merk" value="{{ old('merk', $merk->nama_merk) }}">
                    @error('merk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
</x-app-layout>
