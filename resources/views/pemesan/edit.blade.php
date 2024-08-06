<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60 px-2">
            {{ __('Data Pemesan') }}
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
                        <!-- Form dengan shadow -->
                        <form method="POST" action="{{ route('pemesans.update', $pemesan->id) }}" class="shadow p-3 mb-5 bg-white rounded" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan"
                                    class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan"
                                    value="{{ old('nama_pemesan', $pemesan->nama_pemesan) }}">
                                @error('nama_pemesan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    value="{{ old('alamat', $pemesan->alamat) }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" name="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    value="{{ old('no_hp', $pemesan->no_hp) }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img id="imagePreview"
                                    src="{{ asset('storage/public/images/' . $pemesan->image) }}" 
                                    alt="Preview Image"
                                    style="display: {{ $pemesan->image ? 'block' : 'none' }}; width: 200px;">
                            </div>                           
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Pemesan</label>
                                <input type="file" name="image" onchange="previewImage()"
                                value="{{ old('image', $pemesan->image) }}"
                                class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('pemesans.index') }}" class="btn btn-secondary ml-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script>
        function previewImage() {
            const fileInput = document.getElementById('image');
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





