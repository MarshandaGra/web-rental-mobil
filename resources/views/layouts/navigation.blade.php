<nav x-data="{ open: false }" class="bg-[#3ca0f2] text-white w-64 h-screen fixed">
    <div class="p-4">
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>

        <div class="mt-10 space-y-2">
            <!-- Navigation Links -->
            <hr>
            <a href="{{ route('dashboard') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('dashboard') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-tachometer-alt pr-2"></i> {{ __('Dashboard') }}
            </a>
            <hr>

            <a href="{{ route('merks.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('merks.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-marker pr-2"></i> {{ __('Data Merk') }}
            </a>

            <a href="{{ route('mobils.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('mobils.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-car-side pr-2"></i> {{ __('Data Mobil') }}
            </a>
            <hr>
            <a href="{{ route('pemesans.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('pemesans.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-user pr-2"></i> {{ __('Data Pemesan') }}
            </a>
            <a href="{{ route('bayar.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('bayar.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-money-bill pr-2"></i> {{ __('Data Jenis Bayar') }}
            </a>
            <hr>
            <a href="{{ route('pesanan.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('pesanan.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-hand-holding-heart pr-2"></i> {{ __('Data Penyewaan') }}
            </a>
            <a href="{{ route('penyewaan.riwayat') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('penyewaan.riwayat') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fa-solid fa-clock-rotate-left pr-2"></i> {{ __('Histori Penyewa') }}
            </a>
        </div>

        <hr>
        <div class="hidden sm:flex sm:items-center sm:ms-6 mt-6">
            <x-dropdown align="right" width="28">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-5 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
