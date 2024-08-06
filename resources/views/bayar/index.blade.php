<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60">
            {{ __('Data Jenis Pembayaran') }}
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
                        <form method="post" action="{{ route('bayar.store') }}"
                            class="shadow p-3 mb-5 bg-white rounded">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_bayar" class="form-label">Jenis Pembayaran</label>
                                <input type="text" name="jenis_bayar"
                                    class="form-control @error('jenis_bayar') is-invalid @enderror" id="jenis_bayar"
                                    placeholder="Masukkan jenis bayar">
                                @error('jenis_bayar')
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
                            <h4 class="bg-secondary text-white p-2 rounded">Data Jenis Bayar</h4>
                        </div>
                        <form method="GET" action="{{ route('bayar.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control mr-2 rounded shadow"
                                    placeholder="Cari Jenis Pembayaran..." value="{{ $search }}">
                                <button class="btn btn-outline-secondary rounded shadow" type="submit">Cari</button>
                            </div>
                        </form>
                        <table class="table table-bordered shadow">
                            <thead>
                                <tr>
                                    <th>Jenis Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->jenis_bayar }}</td>
                                        <td>
                                            <a href="{{ route('bayar.edit', $item->id) }}"
                                                class="btn btn-warning">Ubah</a>
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
                        {{ $bayar->appends(request()->input())->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>


</x-app-layout>
