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

                <form action="{{ route('pesanan.kembali', $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="denda">Denda:</label>
                        <input type="number" id="denda" name="denda" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kembalikan</button>
                </form>
            </main>
        </div>
    </div>
</x-app-layout>
