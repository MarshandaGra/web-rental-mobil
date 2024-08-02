<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60 px-2">
            {{ __('Data Penyewaan - ').$pesanan->pemesan->nama_pemesan }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-60 p-3">
            <main class="container mx-auto">

                <div class="row mt-4">
                    <div class="col-8">
                        <!-- Header dengan warna biru -->
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
                        </div>
                        <form method="POST" action="{{ route('pesanan.update', $pesanan->id) }}"
                            class="shadow p-3 mb-5 bg-white rounded">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="pemesan" class="form-label">Nama Pemesan</label>
                                <select name="pemesan" id="pemesan"
                                    class="form-control  @error('pemesan') is-invalid @enderror">
                                    <option value="">--Nama Pemesan--</option>
                                    @foreach ($pemesan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('pemesan', $pesanan->pemesan_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_pemesan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemesan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="mobil" class="form-label">Mobil</label>
                                <select name="mobil" id="mobil"
                                    class="form-control  @error('mobil') is-invalid @enderror">
                                    <option value="">--Nama mobil--</option>
                                    @foreach ($mobil as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mobil', $pesanan->mobil_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_m }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mobil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bayar" class="form-label">Bayar</label>
                                <select name="bayar" id="bayar"
                                    class="form-control  @error('bayar') is-invalid @enderror">
                                    <option value="">--Jenis Bayar--</option>
                                    @foreach ($bayar as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('bayar', $pesanan->bayar_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->jenis_bayar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai"
                                        value="{{ old('tanggal_mulai', $pesanan->tanggal_mulai) }}"
                                        class="form-control  @error('tanggal_mulai') is-invalid @enderror"
                                        id="tanggal_mulai">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="tanggal_kembali"
                                        value="{{ old('tanggal_kembali', $pesanan->tanggal_kembali) }}"
                                        class="form-control  @error('tanggal_kembali') is-invalid @enderror"
                                        id="tanggal_kembali">
                                    @error('tanggal_kembali')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
