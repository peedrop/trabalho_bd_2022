<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <x-nav-dropdown title="Apps" align="right" width="48">
                        @can('view-any', App\Models\Aluno::class)
                        <x-dropdown-link href="{{ route('alunos.index') }}">
                        Alunos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Curso::class)
                        <x-dropdown-link href="{{ route('cursos.index') }}">
                        Cursos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Departamento::class)
                        <x-dropdown-link href="{{ route('departamentos.index') }}">
                        Departamentos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Disciplina::class)
                        <x-dropdown-link href="{{ route('disciplinas.index') }}">
                        Disciplinas
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Equipamento::class)
                        <x-dropdown-link href="{{ route('equipamentos.index') }}">
                        Equipamentos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Faculdade::class)
                        <x-dropdown-link href="{{ route('faculdades.index') }}">
                        Faculdades
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Professor::class)
                        <x-dropdown-link href="{{ route('professors.index') }}">
                        Professores
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Reserva::class)
                        <x-dropdown-link href="{{ route('reservas.index') }}">
                        Reservas
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Sala::class)
                        <x-dropdown-link href="{{ route('salas.index') }}">
                        Salas
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Turma::class)
                        <x-dropdown-link href="{{ route('turmas.index') }}">
                        Turmas
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\User::class)
                        <x-dropdown-link href="{{ route('users.index') }}">
                        Usu??rios
                        </x-dropdown-link>
                        @endcan
                </x-nav-dropdown>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
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

                @can('view-any', App\Models\Aluno::class)
                <x-responsive-nav-link href="{{ route('alunos.index') }}">
                Alunos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Curso::class)
                <x-responsive-nav-link href="{{ route('cursos.index') }}">
                Cursos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Departamento::class)
                <x-responsive-nav-link href="{{ route('departamentos.index') }}">
                Departamentos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Disciplina::class)
                <x-responsive-nav-link href="{{ route('disciplinas.index') }}">
                Disciplinas
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Equipamento::class)
                <x-responsive-nav-link href="{{ route('equipamentos.index') }}">
                Equipamentos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Faculdade::class)
                <x-responsive-nav-link href="{{ route('faculdades.index') }}">
                Faculdades
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Professor::class)
                <x-responsive-nav-link href="{{ route('professors.index') }}">
                Professores
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Reserva::class)
                <x-responsive-nav-link href="{{ route('reservas.index') }}">
                Reservas
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Sala::class)
                <x-responsive-nav-link href="{{ route('salas.index') }}">
                Salas
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Turma::class)
                <x-responsive-nav-link href="{{ route('turmas.index') }}">
                Turmas
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\User::class)
                <x-responsive-nav-link href="{{ route('users.index') }}">
                Usu??rios
                </x-responsive-nav-link>
                @endcan

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>