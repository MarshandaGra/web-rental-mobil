<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60 px-2">
            {{ __('Data Penyewaan') }}
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

                <div class="row mt-4">
                    <div class="col-12">
                        <!-- Header dengan warna biru -->
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Data Penyewa</h4>
                        </div>
                        
                        @if ($pesanan->isEmpty())
                            <div class="alert alert-warning" role="alert">
                            Data tidak ditemukan.
                            </div>
                        @else
                        
                        <div class="col-7">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                                <i class="fa-solid fa-plus"></i>
                                    <span>Tambah Data</span>
                                </button>
                        </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="addDataModal" tabindex="-1"
                                                    aria-labelledby="addDataModalLabel" aria-hidden="true"
                                                    data-bs-backdrop="static">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addDataModalLabel">Tambah
                                                                    Data</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post"
                                                                    action="{{ route('pesanan.store') }}">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="pemesan" class="form-label">Nama
                                                                            Pemesan</label>
                                                                        <select name="pemesan" id="pemesan"
                                                                            class="form-control @error('pemesan') is-invalid @enderror">
                                                                            <option value="">--Nama Pemesan--
                                                                            </option>
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
                                                                        <label for="mobil"
                                                                            class="form-label">Mobil</label>
                                                                        <select name="mobil" id="mobil"
                                                                            class="form-control @error('mobil') is-invalid @enderror">
                                                                            <option value="">--Nama mobil--
                                                                            </option>
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
                                                                        <label for="bayar"
                                                                            class="form-label">Bayar</label>
                                                                        <select name="bayar" id="bayar"
                                                                            class="form-control @error('bayar') is-invalid @enderror">
                                                                            <option value="">--Jenis Bayar--
                                                                            </option>
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
                                                                            <label for="tanggal_mulai"
                                                                                class="form-label">Tanggal
                                                                                Mulai</label>
                                                                            <input type="date" name="tanggal_mulai"
                                                                                value="{{ old('tanggal_mulai') }}"
                                                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                                                id="tanggal_mulai">
                                                                            @error('tanggal_mulai')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="tanggal_kembali"
                                                                                class="form-label">Tanggal
                                                                                Kembali</label>
                                                                            <input type="date"
                                                                                name="tanggal_kembali"
                                                                                value="{{ old('tanggal_kembali') }}"
                                                                                class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                                                                id="tanggal_kembali">
                                                                            @error('tanggal_kembali')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Tambah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                        <th>Total Bayar</th>
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
                                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }}
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_kembali)->format('d M Y') }}
                                                            </td>
                                                            <td>Rp {{ number_format($data->harga_total, 2, ',', '.') }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('pesanan.edit', $data->id) }}"
                                                                    class="btn btn-warning p-2">Edit</a>
                                                                <a href="{{ route('pesanan.kembali.form', $data->id) }}"
                                                                    class="btn btn-success p-2"
                                                                    onclick="return confirm('Apakah mobil sudah kembali?')">Kembalikan</a>

                                                                <form
                                                                    action="{{ route('pesanan.destroy', $data->id) }}"
                                                                    method="POST" style="display: inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger pr-3 p-2"
                                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                                                </form>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $pesanan->appends(['search' => $search])->links() }}
                                        @endif
                                    </div>
                                </div>
            </main>
        </div>
    </div>
</x-app-layout>
