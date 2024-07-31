<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.4/dist/tailwind.min.css" rel="stylesheet">

    <style>

    </style>
</head>

<body>
    <nav x-data="{ open: false, sidebarOpen: false, activeLink: '' }" class="flex h-screen text-gray-900 bg-blue-500">
        <!-- Sidebar -->
        <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 z-40 sm:hidden" @click="sidebarOpen = false"></div>
        <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            class="fixed inset-y-0 left-0 transform transition-transform text-light shadow-md w-64 z-50 sm:translate-x-0 sm:relative">
            <div class="flex items-center justify-between p-4 border-b border-dark-lighter">
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-light">
                    <x-application-logo class="block h-9 w-auto fill-current text-light" />
                </a>
                <button @click="sidebarOpen = false" class="text-light hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="mt-6 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'dashboard'}" @click="activeLink = 'dashboard'"
                    class="text-white font-size-200">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <hr class="opacity-35">
                <p class="mt-4 ml-4 text-sm font-medium text-light text-gray-100 opacity-75">Master Mobil</p>
                <x-responsive-nav-link :href="route('merks.index')" :class="{'nav-link-active': activeLink === 'merk'}" @click="activeLink = 'merk'"
                    class="text-white">
                    <i class="fa-solid fa-igloo"></i>
                    {{ __('Data Merk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mobils.index')" :class="{'nav-link-active': activeLink === 'mobil'}" @click="activeLink = 'mobil'"
                    class="text-white">
                    {{ __('Data Mobil') }}
                </x-responsive-nav-link>
                <hr class=" opacity-35">
                <p class="mt-4 ml-4 text-sm font-medium text-light text-gray-100 opacity-75">Master Pemesanan</p>
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'pemesan'}" @click="activeLink = 'pemesan'"
                    class="text-white">
                    {{ __('Data Pemesan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'jenis_bayar'}" @click="activeLink = 'jenis_bayar'"
                    class="text-white">
                    {{ __('Data Jenis Bayar') }}
                </x-responsive-nav-link>
                <hr class=" opacity-35">
                <p class="mt-4 ml-4 text-sm font-medium text-light text-gray-100 opacity-75">Master Pesanan</p>
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'pesanan'}" @click="activeLink = 'pesanan'"
                    class="text-white">
                    {{ __('Data Pesanan') }}
                </x-responsive-nav-link>
                <p class="mt-4 ml-4 text-sm font-medium text-light text-gray-100 opacity-75">Riwayat</p>
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'pesanan'}" @click="activeLink = 'pesanan'"
                    class="text-white">
                    {{ __('Riwayat Pesanan') }}
                </x-responsive-nav-link>

            </nav>
            <div class="mt-6 px-4">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white">
            <!-- Header -->
            {{-- <header class="border-b border-gray-200 p-4 flex items-center justify-between shadow-sm bg-transparent">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center p-2 rounded-md text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <h1 class="text-lg font-bold">Dashboard</h1>
            </header> --}}

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</body>

</html>
