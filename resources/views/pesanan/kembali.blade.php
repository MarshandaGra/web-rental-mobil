<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengembalian Mobil') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-64 p-4">
            <main class="container mx-auto">
                <h1 class="h3">Pengembalian Mobil</h1>
                <div class="mt-1 text-sm text-red-600">Denda keterlambatan per hari Rp 500.000
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <form action="{{ route('pesanan.kembali', $pesanan->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kembali_sebenarnya" class="mt-3">Tanggal Kembali Sebenarnya</label>
                                <input type="date" name="kembali_sebenarnya" id="kembali_sebenarnya"
                                    class="form-control" required>
                                @error('kembali_sebenarnya')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Kembalikan Mobil</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
