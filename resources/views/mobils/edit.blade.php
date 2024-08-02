<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60 px-2">
            {{ __('Data Mobil') }}
        </h2>
    </x-slot>


    <div class="flex">
        <div class="flex-1 ml-60 p-3">
            <main class="container mx-auto">
            
            <div class="row mt-4">
                <div class="col-8">
                    <div class="mb-3">
                        <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
                    </div>
                    <form method="post" action="{{ route('mobils.update', $mobil->id) }}" enctype="multipart/form-data"
                        class="shadow p-3 mb-5 bg-white rounded">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="mobil" class="form-label">Nama Mobil</label>
                            <input type="text" value="{{ old('mobil', $mobil->nama_m) }}" name="mobil"
                                class="form-control  @error('mobil') is-invalid @enderror" id="mobil"
                                placeholder="Masukkan nama mobil">
                            @error('mobil')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="merk" class="form-label">Nama Merk</label>
                            <select name="merk" id="merk"
                                class="form-control  @error('merk') is-invalid @enderror">
                                <option value="">--Pilih Merk Mobil--</option>
                                @foreach ($merk as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('merk', $mobil->merk_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_merk }}</option>
                                @endforeach
                            </select>
                            @error('merk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="kursi" class="form-label">Jumlah Kursi</label>
                                <input type="number" name="kursi" value="{{ old('kursi', $mobil->kursi) }}"
                                    class="form-control  @error('kursi') is-invalid @enderror" id="kursi"
                                    placeholder="Jumlah kursi mobil">
                                @error('kursi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="npolisi" class="form-label">No Polisi</label>
                                <input type="text" name="npolisi" value="{{ old('npolisi', $mobil->nomor_polisi) }}"
                                    class="form-control  @error('npolisi') is-invalid @enderror" id="npolisi"
                                    placeholder="No polisi mobil">
                                @error('npolisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" name="tahun" value="{{ old('tahun', $mobil->tahun) }}"
                                    class="form-control  @error('tahun') is-invalid @enderror" id="tahun"
                                    placeholder="Tahun mobil">
                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="harga_per_hari" class="form-label">Harga per hari</label>
                                <input type="number" name="harga_per_hari"
                                    value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}"
                                    class="form-control  @error('harga_per_hari') is-invalid @enderror"
                                    id="harga_per_hari" placeholder="Harga per hari mobil">
                                @error('harga_per_hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Preview Image -->
                        <div class="mb-3">
                            <img id="imagePreview"
                                src="{{ asset('storage/public/images/' . $mobil->gambar) }}" 
                                alt="Preview Gambar"
                                style="display: {{ $mobil->gambar ? 'block' : 'none' }}; width: 200px;">
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Mobil</label>
                            <input type="file" name="gambar" onchange="previewImage()"
                                value="{{ old('gambar', $mobil->gambar) }}"
                                class="form-control @error('gambar') is-invalid @enderror" id="gambar">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('mobils.index') }}" class="btn btn-warning ml-3">Kembali</a>
                    </form>
                </div>
            </div>
        </main>
        </div>
    </div>

    <script>
        function previewImage() {
            const fileInput = document.getElementById('gambar');
            const preview = document.getElementById('imagePreview');

            // Menghapus preview gambar sebelumnya
            preview.style.display = 'none';

            // Cek apakah ada file yang dipilih
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set src gambar preview dan tampilkan
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                // Membaca file
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
</x-app-layout>
