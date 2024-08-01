<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesan') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <p class="h3">Form Edit Data Pemesan</p>

                <div class="row mt-4">
                    <div class="col-5">
                        <!-- Header dengan warna biru -->
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
                        </div>
                        <!-- Form dengan shadow -->
                        <form method="POST" action="{{ route('pemesans.update', $pemesan->id) }}"
                            class="shadow p-3 mb-5 bg-white rounded" enctype="multipart/form-data">
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
                                    src="{{ $pemesan->image ? Storage::url('images/' . $pemesan->image) : '' }}"
                                    alt="Preview image"
                                    style="display: {{ $pemesan->image ? 'block' : 'none' }}; width: 100px;">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Pemesan</label>
                                <input type="file" name="gambar" id="gambar" class="form-control"
                                    onchange="previewImage()">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script>
        function previewImage() {
            const fileInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('imagePreview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
