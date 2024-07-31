<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pemesan - ') . $pemesan->nama_pemesan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex">
                        <div class="p-2">
                            <img src="{{ asset('storage/'.$pemesan->image) }}" class="rounded" alt="{{ $pemesan->nama_pemesan}}" width="200">
                        </div>
                        <div class="p-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama Pemesan</td>
                                    <td>: {{ $pemesan->nama_pemesan}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $pemesan->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>: {{ $pemesan->no_hp}}</td>
                                </tr>
                            </table>
                            <a href="{{ route('pemesan.edit', $pemesan->id) }}" class="btn btn-warning">Ubah</a>
                            <form action="{{ route('pemesan.destroy', $pemesan->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('pemesan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
