<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesan') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <h1 class="h3">Data Penyewa</h1>
                <ul class="list-group mt-3">
                    <li class="list-group-item list-group-item-dark text-secondary">Data Penyewa Mobil</li>
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
                        <form method="post" action="{{ route('pesanan.store') }}"
                            class="shadow p-3 mb-5 bg-white rounded">
                            @csrf
                            <div class="mb-3">
                                <label for="pemesan" class="form-label">Nama Pemesan</label>
                                <select name="pemesan" id="pemesan"
                                    class="form-control  @error('pemesan') is-invalid @enderror">
                                    <option value="">--Nama Pemesan--</option>
                                    @foreach ($pemesan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('pemesan') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_pemesan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemesan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="mobil" class="form-label">Mobil</label>
                                <select name="mobil" id="mobil"
                                    class="form-control  @error('mobil') is-invalid @enderror">
                                    <option value="">--Nama mobil--</option>
                                    @foreach ($mobil as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mobil') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_m }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mobil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bayar" class="form-label">Bayar</label>
                                <select name="bayar" id="bayar"
                                    class="form-control  @error('bayar') is-invalid @enderror">
                                    <option value="">--Jenis Bayar--</option>
                                    @foreach ($bayar as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('bayar') == $item->id ? 'selected' : '' }}>
                                            {{ $item->jenis_bayar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                        class="form-control  @error('tanggal_mulai') is-invalid @enderror"
                                        id="tanggal_mulai">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                                        class="form-control  @error('tanggal_kembali') is-invalid @enderror"
                                        id="tanggal_kembali">
                                    @error('tanggal_kembali')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                    <div class="col-8">
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Data Penyewa</h4>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pemesan</th>
                                    <th>Mobil</th>
                                    <th>Jenis Bayar</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->pemesan->nama_pemesan }}</td>
                                        <td>{{ $data->mobil->nama_m }}</td>
                                        <td>{{ $data->bayar->jenis_bayar }}</td>
                                        <td>{{ $data->tanggal_mulai }}</td>
                                        <td>{{ $data->tanggal_kembali }}</td>
                                        <td>
                                            <a href="{{ route('pesanan.edit', $data->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('pesanan.destroy', $data->id) }}" method="POST"
                                                style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
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
