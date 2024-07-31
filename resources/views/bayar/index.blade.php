<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jenis Pembayaran') }}
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
                <form method="post" action="{{ route('bayar.store') }}" class="shadow p-3 mb-5 bg-white rounded mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_bayar" class="form-label">Jenis Pembayaran</label>
                        <input type="text" name="jenis_bayar" class="form-control @error('jenis_bayar') is-invalid @enderror"
                            id="jenis_bayar" placeholder="Masukkan jenis bayar">
                        @error('jenis_bayar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
            <div class="col-md-7 ">
                <div class="mt-4">
                    <h4 class="bg-secondary text-white p-2 rounded">Data Jenis Pembayaran</h4>
                </div>
                    <table id="bayarTable" class="table table-bordered">
                    <div class="mt-3 mb-3 col-7 d-flex justify-content-between align-items-center">
                        <form action="{{ route('bayar.index') }}" method="GET" class="d-flex">
                            <input type="text" name="query" class="form-control rounded ml-2 shadow" placeholder="Cari..." value="{{ request()->query('query') }}">
                            <button type="submit" class="btn btn-secondary ml-2 shadow">Cari</button>
                        </form>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bayar as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->jenis_bayar }}</td>
                                <td>
                                    <a href="{{ route('bayar.edit', $item->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('bayar.destroy', $item->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus jenis bayar ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $bayar->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#bayarTable').DataTable({
                "language": {
                    "search": "Cari:"
                }
            });
        });
    </script>
</x-app-layout>





