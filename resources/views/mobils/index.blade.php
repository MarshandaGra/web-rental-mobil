<x-app-layout class="d-flex">
    <style>
        .detail-column {
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60 px-2">
            {{ __('Data Mobil') }}
        </h2>
    </x-slot>


    <div class="flex">
        <div class="flex-1 ml-60 p-3">
            <main class="container mx-auto">
                
                @if (session()->has('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('danger'))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session('danger') }}
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
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Tambah Data</h4>
                        </div>
                        <form method="post" action="{{ route('mobils.store') }}" enctype="multipart/form-data"
                            class="shadow p-3 mb-5 bg-white rounded">
                            @csrf
                            <div class="mb-3">
                                <label for="mobil" class="form-label">Nama Mobil</label>
                                <input type="text" value="{{ old('mobil') }}" name="mobil"
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
                                            {{ old('merk') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_merk }}
                                        </option>
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
                                    <input type="number" name="kursi" value="{{ old('kursi') }}"
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
                                    <input type="text" name="npolisi" value="{{ old('npolisi') }}"
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
                                    <input type="number" name="tahun" value="{{ old('tahun') }}"
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
                                    <input type="number" name="harga_per_hari" value="{{ old('harga_per_hari') }}"
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
                                <img id="imagePreview" src="" alt="Preview Gambar"
                                style="display: none; width: 100px; height: auto;">
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Mobil</label>
                                <input type="file" name="gambar" onchange="previewImage()"
                                    class="form-control  @error('gambar') is-invalid @enderror" id="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                    <div class="col-7">
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Data Mobil</h4>
                        </div>
                        <form method="GET" action="{{ route('mobils.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control mr-2 rounded shadow" placeholder="Cari Pemesan..." value="{{ $search }}">
                                <button class="btn btn-outline-secondary rounded shadow" type="submit">Cari</button>
                            </div>
                        </form>
                        <table class="table table-bordered shadow">
                            <thead>
                                <tr>
                                    <th>Mobil</th>
                                    <th>Merk</th>
                                    <th>Kursi</th>
                                    <th class="detail-column">No Polisi</th>
                                    <th class="detail-column">Tahun</th>
                                    <th class="detail-column">Harga Per Hari</th>
                                    <th class="detail-column">Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobil as $data)
                                    <tr>
                                        <td>{{ $data->nama_m }}</td>
                                        <td>{{ $data->merk->nama_merk }}</td>
                                        <td>{{ $data->kursi }}</td>
                                        <td class="detail-column">{{ $data->no_polisi }}</td>
                                        <td class="detail-column">{{ $data->tahun }}</td>
                                        <td class="detail-column">{{ $data->harga_per_hari }}</td>
                                        <td class="detail-column">
                                            @if ($data->gambar)
                                                <img src="{{ Storage::url('images/' . $data->gambar) }}"
                                                    style="width: 50px;">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mobils.edit', $data->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('mobils.show', $data->id) }}"
                                                class="btn btn-info">Detail</a>
                                            <form action="{{ route('mobils.destroy', $data->id) }}" method="POST"
                                                style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin inggin menghapus data ini')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $mobil->appends(['search' => $search])->links() }}
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
</x-app-layout>`
