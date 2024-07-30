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
                <x-responsive-nav-link :href="route('dashboard')" :class="{'nav-link-active': activeLink === 'mobil'}" @click="activeLink = 'mobil'"
                    class="text-white">
                    {{ __('Data Mobil') }}
                </x-responsive-nav-link>
                <hr class=" opacity-35">
                <p class="mt-4 ml-4 text-sm font-medium text-light text-gray-100 opacity-75">Master Pemesanan</p>
                <x-responsive-nav-link :href="route('pemesan.index')" :class="{'nav-link-active': activeLink === 'pemesan'}" @click="activeLink = 'pemesan'"
                    class="text-white">
                    {{ __('Data Pemesan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bayar.index')" :class="{'nav-link-active': activeLink === 'jenis_bayar'}" @click="activeLink = 'jenis_bayar'"
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
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</body>

</html>