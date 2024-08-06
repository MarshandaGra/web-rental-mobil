<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60">
            {{ __('Data Merk') }}
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
                        <!-- Header dengan warna biru -->
                        <div class="mb-3">
                            <h4 class="bg-secondary text-white p-2 rounded">Tambah Data</h4>
                        </div>
                        <!-- Form dengan shadow -->
                        <form method="post" action="{{ route('merks.store') }}"
                            class="shadow p-3 mb-5 bg-white rounded">
                            @csrf
                            <div class="mb-3">
                                <label for="merk" class="form-label">Nama Merk</label>
                                <input type="text" name="merk"
                                    class="form-control  @error('merk') is-invalid @enderror" id="merk"
                                    placeholder="Masukkan nama merk">
                                @error('merk')
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
                            <h4 class="bg-secondary text-white p-2 rounded">Data Merk</h4>
                        </div>
                        <form method="GET" action="{{ route('merks.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control mr-2 rounded shadow"
                                    placeholder="Cari Merk..." value="{{ $search }}">
                                <button class="btn btn-outline-secondary rounded shadow" type="submit">Cari</button>
                            </div>
                        </form>
                        <table class="table table-bordered">
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
                                            <a href="{{ route('merks.edit', $data->id) }}"
                                                class="btn btn-warning">Edit</a>

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
                        {{ $merks->appends(request()->input())->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>






    </div>
</x-app-layout>
