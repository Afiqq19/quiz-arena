<nav x-data="{ open: false }" class="glass-panel border-b-0 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center shadow-lg shadow-fuchsia-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-black text-2xl tracking-tight text-white hidden sm:block">QUIZ<span class="text-fuchsia-500">ARENA</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            {{ __('Dasbor') }}
                        </a>
                    
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.leaderboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.leaderboard') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Papan Peringkat') }}
                            </a>
                            <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('quizzes.*') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Kelola Kuis') }}
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.users.*') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Pemain') }}
                            </a>
                            <a href="{{ route('admin.attempts.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.attempts.*') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Histori Pengerjaan') }}
                            </a>
                            <a href="{{ route('admin.backup.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.backup.*') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Backup') }}
                            </a>
                        @else
                            <a href="{{ route('leaderboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('leaderboard') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Papan Peringkat') }}
                            </a>
                            <a href="{{ route('quiz.history') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('quiz.history') ? 'border-fuchsia-500 text-white' : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Histori Kuis Saya') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/10 text-sm leading-4 font-medium rounded-full text-white bg-gray-900/40 hover:bg-white/10 focus:outline-none transition-all duration-300 backdrop-blur-md shadow-lg shadow-black/20 group">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-7 h-7 rounded-full mr-2 object-cover border border-white/20 shadow-sm transition-transform group-hover:scale-110" referrerpolicy="no-referrer">
                            @else
                                <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-fuchsia-500 to-blue-500 mr-2 flex items-center justify-center text-[10px] font-bold text-white border border-white/20 shadow-sm transition-transform group-hover:scale-110">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="font-semibold">{{ Auth::user()->name }}</div>
                            <x-rank-badge :streak="Auth::user()->room_streak" />

                            <div class="ms-2 transition-transform duration-300 group-hover:rotate-180">
                                <svg class="fill-current h-4 w-4 text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-gray-900/95 backdrop-blur-xl text-white rounded-2xl border border-white/10 shadow-[0_10px_40px_rgba(0,0,0,0.5)] overflow-hidden py-2 mt-1">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-white/5 focus:bg-white/5 text-gray-300 hover:text-white transition-all flex items-center gap-3 px-5 py-2.5">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-fuchsia-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            <div class="border-t border-white/5 my-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="hover:bg-red-500/10 focus:bg-red-500/10 text-gray-300 hover:text-red-400 transition-all flex items-center gap-3 px-5 py-2.5 group">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full font-bold text-xs bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 text-white shadow-lg transition-all hover:scale-105 active:scale-95">Daftar</a>
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900/95 backdrop-blur-md border-b border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.leaderboard')" :active="request()->routeIs('admin.leaderboard')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Papan Peringkat') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('quizzes.index')" :active="request()->routeIs('quizzes.*')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Kelola Kuis') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Pemain') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.attempts.index')" :active="request()->routeIs('admin.attempts.*')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Histori Pengerjaan') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.backup.index')" :active="request()->routeIs('admin.backup.*')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Backup Data') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('leaderboard')" :active="request()->routeIs('leaderboard')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Papan Peringkat') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('quiz.history')" :active="request()->routeIs('quiz.history')" class="text-gray-300 hover:bg-gray-800 hover:text-white focus:bg-gray-800 focus:text-white border-transparent">
                        {{ __('Histori Kuis Saya') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-2 border-t border-white/10">
            <div class="px-5 flex items-center gap-3 mb-4">
                @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-white/20 shadow-sm" referrerpolicy="no-referrer">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-fuchsia-500 to-blue-500 flex items-center justify-center text-sm font-bold text-white border border-white/20 shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white border-transparent flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-400 hover:text-red-300 border-transparent flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-700">
            <x-responsive-nav-link :href="route('login')" class="text-gray-300 hover:bg-gray-800 hover:text-white border-transparent">
                {{ __('Masuk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" class="text-gray-300 hover:bg-gray-800 hover:text-white border-transparent">
                {{ __('Daftar') }}
            </x-responsive-nav-link>
        </div>
        @endauth
    </div>
</nav>
