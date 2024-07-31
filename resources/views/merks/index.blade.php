<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Merk') }}
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
                    <h4 class="bg-secondary text-white p-2 rounded">Tambah Data</h4>
                </div>
                <!-- Form dengan shadow -->
                <form method="post" action="{{ route('merks.store') }}" class="shadow p-3 mb-5 bg-white rounded mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="merk" class="form-label">Nama Merk</label>
                        <input type="text" name="merk" class="form-control  @error('merk') is-invalid @enderror"
                            id="merk" placeholder="Masukkan nama merk">
                        @error('merk')
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
                    <h4 class="bg-secondary text-white p-2 rounded">Data Merk</h4>
                </div>
                <table id="merkTable" class="table table-bordered ">
                    <div class="mt-3 mb-3 col-7 d-flex justify-content-between align-items-center">
                        <form method="GET" action="{{ route('merks.index') }}" class="d-flex">
                                <input type="text" name="query" class="form-control rounded ml-2 shadow" placeholder="Cari Merek..." value="{{ request()->query('query') }}">
                                <button class="btn btn-secondary ml-2 shadow" type="submit">Cari</button>
                        </form>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merks as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_merk }}</td>
                                <td>
                                    <a href="{{ route('merks.edit', $data->id) }}" class="btn btn-warning">Edit</a>

                                    <form action="{{ route('merks.destroy', $data->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin inggin menghapus merk ini')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $merks->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#merkTable').DataTable({
                "language": {
                    "search": "Cari:"
                }
            });
        });
    </script>
</x-app-layout>
