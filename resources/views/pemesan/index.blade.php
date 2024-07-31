<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesan') }}
        </h2>
    </x-slot>
    <div class="container-fluid mt-1">
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <!-- Header dengan warna biru -->
                <div class="mt-4">
                    <h4 class="bg-secondary text-white p-2 rounded">Tambah Data Pemesan</h4>
                </div>
                <!-- Form dengan shadow -->
                <form method="post" action="{{ route('pemesan.store') }}" class="shadow p-3 mb-5 bg-white rounded mt-3" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" class="form-control  @error('nama_pemesan') is-invalid @enderror"
                            id="nama_pemesan" placeholder="Masukkan nama pemesan">
                        @error('nama_pemesan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control  @error('alamat') is-invalid @enderror"
                            id="alamat" placeholder="Masukkan alamat">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control  @error('no_hp') is-invalid @enderror"
                            id="no_hp" placeholder="Masukkan nomor hp">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
            <div class="col-md-8">
                    <div class="mt-4">
                        <h4 class="bg-secondary text-white p-2 rounded">Data Pemesan</h4>
                    </div>
                    <table id="pemesanTable" class="table table-bordered shadow">
                        <div class="mt-3 mb-3 col-7 d-flex justify-content-between align-items-center">
                            <form method="GET" action="{{ route('pemesan.index') }}" class="d-flex">
                                    <input type="text" name="search" class="form-control rounded ml-2 shadow" placeholder="Cari Pemesan..." value="{{ $search }}">
                                    <button class="btn btn-secondary ml-2 shadow" type="submit">Cari</button>
                            </form>
                        </div>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
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
                                    <a href="{{ route('pemesan.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('pemesan.show', $data->id) }}" class="btn btn-secondary">Detail</a>
                                    <form action="{{ route('pemesan.destroy', $data->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin inggin menghapus data ini')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                <!-- Pagination Links -->
                {{ $pemesan->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>

    </div>

    <script>
        
        function previewImage(){
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';
    const ofReader = new FileReader();
    ofReader.readAsDataURL(image.files[0]);

    ofReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
    }
    }

    $(document).ready(function() {
            $('#pemesanTable').DataTable({
                "language": {
                    "search": "Cari:"
                }
            });
        });
    </script>
</x-app-layout>
