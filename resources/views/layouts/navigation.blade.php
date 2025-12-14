<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- PRIMARY NAVIGATION MENU -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE (Logo + Dashboard Link) -->
            <div class="flex">
                <!-- LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- MAIN NAVIGATION LINKS -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- ================================ -->
                    <!-- 📌 ECORIDE MENU ITEM (USERS ONLY) -->
                    <!-- ================================ -->
                    @auth
                        @if(auth()->user()->role === 'user')
                            <x-nav-link :href="route('ecoride.home')" :active="request()->routeIs('ecoride.home')">
                                {{ __('EcoRide') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- RIGHT SIDE (Settings Dropdown) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- USER DROPDOWN (Displays pseudo + credits) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                            <div>
                                {{ Auth::user()->pseudo }}
                                <span class="text-xs text-green-600">
                                    ({{ Auth::user()->credits }} crédits)
                                </span>
                            </div>

                            <div class="ml-2">
                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Link to profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 focus:outline-none">
                    <!-- Hamburger Icon -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }"
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }"
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MOBILE NAVIGATION MENU -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">

        <!-- Mobile Dashboard -->
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <!-- MOBILE ECORIDE LINK -->
        @auth
            @if(auth()->user()->role === 'user')
                <x-responsive-nav-link :href="route('ecoride.home')" 
                    :active="request()->routeIs('ecoride.home')">
                    {{ __('EcoRide') }}
                </x-responsive-nav-link>
            @endif
        @endauth

        <!-- Mobile user info + credits + logout -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium">{{ Auth::user()->pseudo }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="text-xs text-green-600 font-semibold">
                    Crédits : {{ Auth::user()->credits }}
                </div>
                <div class="text-xs text-gray-400">
                    Role : {{ Auth::user()->role }}
                </div>
            </div>

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
</nav>
