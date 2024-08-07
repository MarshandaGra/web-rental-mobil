<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 ml-60 px-2 leading-tight">
            {{ __('Welcome Back') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex-1 ml-60 p-3">
            <main class="container mx-auto">
                <p class="h3 mt-4 font-semibold">Rental Mobil</p>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div
                            class="card mb-4 bg-light-primary shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <div class="rounded-full d-flex align-items-center justify-content-center p-4">
                                            <i class="fa-solid fa-car fa-2x"></i>
                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <div>
                                            <h6 class="card-subtitle mb-1 text-gray-600">Total Mobil</h6>
                                            <p class="card-text mt-2 pl-8 text-2xl font-bold text-gray-800 ">
                                                {{ $totalMobil }}</p>
                                            <a href="{{ route('mobils.index') }}" class="btn btn-primary mt-2">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div
                            class="card mb-4 bg-light-primary shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <div class="rounded-full d-flex align-items-center justify-content-center p-4">
                                            <i class="fa-solid fa-hand-holding-heart"></i>
                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <div>
                                            <h6 class="card-subtitle mb-1 text-gray-600">Total Penyewa</h6>
                                            <p class="card-text mt-2 pl-8 text-2xl font-bold text-gray-800 ">
                                                {{ $totalPenyewa }}</p>
                                            <a href="{{ route('pemesans.index') }}" class="btn btn-primary mt-2">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
