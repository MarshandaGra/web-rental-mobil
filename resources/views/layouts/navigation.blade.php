<nav x-data="{ open: false }" class="bg-[#3ca0f2] text-white w-64 h-screen fixed">
    <div class="p-4">
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
        </div>

        <div class="mt-10 space-y-2">
            <!-- Navigation Links -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('dashboard') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Dashboard') }}
            </a>

            <a href="{{ route('merks.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('merks.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Data Merk') }}
            </a>

            <a href="{{ route('mobils.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('mobils.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-basket-shopping mr-2"></i> {{ __('Data Mobil') }}
            </a>
            <hr>
            <a href="{{ route('pemesans.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('pemesans.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-basket-shopping mr-2"></i> {{ __('Data Pemesan') }}
            </a>
            <a href="{{ route('bayar.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('bayar.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Data Jenis Bayar') }}
            </a>
            <hr>
            <a href="{{ route('pesanan.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-white hover:text-[#000000] {{ request()->routeIs('pesanan.index') ? 'bg-[#67b8e7]' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> {{ __('Data Penyewaan') }}
            </a>
        </div>
    </div>
</nav>
