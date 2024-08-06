<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-60">
            {{ __('Detail Pemesan - ') . $pemesan->nama_pemesan }}
        </h2>
    </x-slot>

    <div class="flex-1 ml-60 p-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex">
                        <div class="p-2">
                            <img id="imagePreview" src="{{ asset('storage/images/' . $pemesan->image) }}"
                                alt="Preview image"
                                style="display: {{ $pemesan->image ? 'block' : 'none' }}; width: 200px;">
                        </div>
                        <div class="p-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama Pemesan</td>
                                    <td>: {{ $pemesan->nama_pemesan }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $pemesan->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>: {{ $pemesan->no_hp }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('pemesans.edit', $pemesan->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pemesans.destroy', $pemesan->id) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                            <a href="{{ route('pemesans.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
