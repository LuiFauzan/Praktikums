<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                {{-- <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto fill-current text-gray-800" />
                    </a>
                </div> --}}

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @if (auth()->user()->role == 'Mahasiswa')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('student')" :active="request()->routeIs('student')">
                        {{ __('Jadwal Anda') }}
                    </x-nav-link>
                </div>  
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('pembayaran.praktikum')" :active="request()->routeIs('pembayaran.praktikum')">
                        {{ __('Pembayaran') }}
                    </x-nav-link>
                </div>  
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('riwayat')" :active="request()->routeIs('riwayat')">
                        {{ __('Riwayat Pembayaran') }}
                    </x-nav-link>
                </div>  
                
                @endif
                @if (auth()->user()->role == 'Asisten Lab' && auth()->user()->praktikum_id == true )
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('jadwalpraktikum')" :active="request()->routeIs('jadwalpraktikum')">
                        {{ __('Jadwal Praktikum') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('daftarpraktikum')" :active="request()->routeIs('daftarpraktikum')">
                        {{ __('Daftar Praktikum') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('mahasiswa')" :active="request()->routeIs('mahasiswa')">
                        {{ __('Data Mahasiswa') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('pembayaran')" :active="request()->routeIs('pembayaran')">
                        {{ __('Data Pembayaran') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('riwayatpembayaran')" :active="request()->routeIs('riwayatpembayaran')">
                        {{ __('Riwayat Pembayaran') }}
                    </x-nav-link>
                </div>  
                @endif
                @if (auth()->user()->role == 'Ketua Lab')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dosen')" :active="request()->routeIs('dosen')">
                        {{ __('Data Dosen') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('aslab')" :active="request()->routeIs('aslab')">
                        {{ __('Data Asisten Lab') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('praktikum')" :active="request()->routeIs('praktikum')">
                        {{ __('Data Praktikum') }}
                    </x-nav-link>
                </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{-- @if (auth()->user()->role == 'Asisten Lab')
                            <div>{{ Auth::user()->nama }} as {{ Auth::user()->role }} {{ Auth::user()->praktikum->nama }}</div>
                            @elseif(auth()->user()->role == 'Ketua Lab')
                            <div>{{ Auth::user()->nama }} as {{ Auth::user()->role }}</div>
                            @else
                            <div>{{ Auth::user()->nama }} as {{ Auth::user()->role }}</div>
                            @endif --}}
                            <div class="ms-1">
                                <div>Dropdown</div>
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link class=" border-b hover:bg-none">
                            @if (auth()->user()->role == 'Asisten Lab')
                           <div>{{ Auth::user()->nama }}</div>
                           <div> {{ Auth::user()->role }}</div>
                           <div> {{ Auth::user()->praktikum->nama }}</div>
                           @elseif(auth()->user()->role == 'Ketua Lab')
                           <div>{{ Auth::user()->nama }} </div>
                           <div> {{ Auth::user()->role }}</div>
                           @else
                           <div>{{ Auth::user()->nama }} </div>
                           <div> {{ Auth::user()->role }}</div>
                           @endif   
                       </x-dropdown-link>
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
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
