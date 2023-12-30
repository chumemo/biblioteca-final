<nav x-data="{ open: false }" class="bg-morado mb-3 fixed top-0 w-full z-10 border-none">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 sm:py-2 lg:px-8 lg:py-4 flex flex-col items-center">
        <div class="flex justify-between  items-end h-34 ">
            <div class="hidden sm:block">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('inicio') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>


            </div>

            <div class="flex items-center justify-center text-crema font-gothamBold md:mx-12 py-2">
                <h1 class="lg:text-2xl md:text-xl">Biblioteca Digital del Régimen Especial Sancionador</h1>
            </div>

            <div class="hidden flex-col sm:flex sm:items-end sm:ms-6">

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="flex flex-col justify-center items-end">

                                    <div class="flex justify-center items-center">
                                        <span class="text-crema font-gothamMedium flex flex-row navLink">Hola
                                            {{ Auth::user()->name }}</span>
                                        <img src="{{ asset('assets/img/AvatarH.png') }}" class="mx-2 " alt="avatar"
                                            width="30px">
                                    </div>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">


                            <x-dropdown-link href="{{ route('admin.home') }}">
                                Panel
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    Salir
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- search input --}}
                <form action="{{ route('busqueda.index')}}" method="POST" id="buscarForm">
                    @method('POST')
                    @csrf
                    <div class="flex flex-row items-center text-center rounded-pill  overflow-hidden border-none mt-2 bg-white h-8 ">
                        <input type="text" name="query" autocomplete="off"
                        class="w-full h-full placeholder-gray-400 border-none" />
                        <img id="buscarIcon" src="{{ asset('assets/img/Buscar.png') }}" alt="Logo usuario" class="h-8 border-none"/>
                    </div>
                </form>


            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        @if (request()->route()->getName() !== 'inicio.index')
            <ul class="flex space-x-4 mt-2">
                <li class="navLink">
                    <a href="{{ route('manual.index') }}" class="text-decoration-none text-crema">
                        MANUALES
                    </a>
                </li>
                <li class="navLink">

                    <a href="{{ route('folleto.index') }}" class="text-decoration-none text-crema">
                        FOLLETOS
                    </a>
                </li>
                <li class="navLink">

                    <a href="{{ route('formato.index') }}" class="text-decoration-none text-crema">
                        FORMATOS
                    </a>
                </li>
                <li class="navLink">

                    <a href="{{ route('catalogo.index') }}" class="text-decoration-none text-crema">
                        CATÁLOGOS
                    </a>
                </li>
                <li class="navLink">

                    <a href="{{ route('documento.index') }}" class="text-decoration-none text-crema">
                        DOCUMENTOS
                    </a> 
                </li>
                <li class="navLink">

                    <a href="{{ route('compendio.index') }}" class="text-decoration-none text-crema">
                        COMPENDIOS
                    </a> 
                </li>
                <li class="navLink">

                    <a href="{{ route('capsula.index') }}" class="text-decoration-none text-crema">
                        CÁPSULAS
                    </a> 
                </li>
            </ul>
        @endif

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>

    <script>
        let buscarBtn = document.querySelector('#buscarIcon');
        let form = document.querySelector('#buscarForm');
        buscarBtn.addEventListener('click', (e) => {
            form.submit();
            console.log('submit');
        })
    </script>
</nav>
