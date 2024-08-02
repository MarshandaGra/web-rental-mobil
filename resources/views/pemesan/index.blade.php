<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesan') }}
        </h2>
    </x-slot>



    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <h1 class="h3">Data Pemesan</h1>
                <ul class="list-group mt-3">
                    <li class="list-group-item list-group-item-dark text-secondary">Data Pemesan</li>
                </ul>

                @if (session()->has('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col-4">
                        <!-- Header dengan warna biru -->
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Tambah Data</h4>
                        </div>
                        <!-- Form dengan shadow -->
                        <form method="post" action="{{ route('pemesans.store') }}"
                            class="shadow p-3 mb-5 bg-white rounded" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan"
                                    class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan"
                                    placeholder="Masukkan nama pemesan">
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
                                    placeholder="Masukkan alamat">
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
                                    placeholder="Masukkan nomor hp">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <img id="imagePreview" src="" alt="Preview Gambar"
                                    style="display: none; width: 100px; height: auto;">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Pemesan</label>
                                <input type="file" name="image" onchange="previewImage()"
                                    class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>

                    <div class="col-8">
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Data Pemesan</h4>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Alamat</th>
                                    <th>Nomor HP</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_pemesan }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->no_hp }}</td>
                                        <td>
                                            @if ($data->image)
                                                <img src="{{ Storage::url('images/' . $data->image) }}"
                                                    style="width: 50px;">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pemesans.edit', $data->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('pemesans.show', $data->id) }}"
                                                class="btn btn-secondary">Detail</a>
                                            <form action="{{ route('pemesans.destroy', $data->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <div class="container mx-auto mt-8 px-4">
        <div class="flex justify-between items-center mb-6">



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
