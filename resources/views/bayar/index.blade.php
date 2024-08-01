<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jenis Pembayaran') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <h1 class="h3">Data Jenis Pembayaran</h1>
                <ul class="list-group mt-3">
                    <li class="list-group-item list-group-item-dark text-secondary">Data Jenis Pembayaran</li>
                </ul>
                @if (session()->has('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
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
                        <table class="table table-bordered">
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
                    </div>
                </div>
            </main>
        </div>
    </div>


</x-app-layout>
