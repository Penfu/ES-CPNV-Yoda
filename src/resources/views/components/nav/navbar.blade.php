@push('scripts')
    <script src="{{ mix('js/navbar.js') }}" defer></script>
@endpush

<div class="fixed top-0 inset-x-0 bg-white shadow-md">
    <nav class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Mobile menu button-->
            <div class="h-full w-full relative flex items-center lg:hidden ">
                <button type="button" id="btn-mobile-menu"
                    class="z-20 inline-flex items-center justify-center p-2 rounded-md text-gray-700 focus:outline-none"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg id="hamburger-mobile-menu" class="block h-10 w-10" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="cross-mobile-menu" class="hidden h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="absolute w-full text-center lg:hidden animate-fade-in-down ">
                    <a href="{{ route('home') }}" class="uppercase font-bold text-2xl">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>

            <!-- Standard menu -->
            <div class="flex-1 flex items-center justify-center lg:items-stretch lg:justify-start h-full ">
                <div class="hidden w-full h-full lg:flex space-x-4">
                    <x-nav.link name="Accueil" route="{{ route('home') }}" />
                    <x-nav.dropdown name="Pratiques" route="{{ route('practices') }}" route-group="practice"
                        title="Liste des pratiques par domaine">
                        @can('moderate')
                            <!-- Moderator only all pratices of every states -->
                            <x-nav.dropdown-link name="Toutes ~ Modération" route="{{ route('practices.moderation') }}" />
                        @endcan

                        <x-nav.dropdown-link name="Toutes {{ $domains->sum('practices_count') }}"
                            route="{{ route('practices') }}" />

                        @foreach ($domains as $domain)
                            <x-nav.dropdown-link name="{!! $domain->name !!} {{ $domain->practices_count }}"
                                route="{{ route('practices.byDomain', ['domain' => $domain->slug]) }}" />
                        @endforeach
                    </x-nav.dropdown>
                    <x-nav.link name="References" route="{{ route('references') }}" />

                    <!-- Login -->
                    <div class="flex items-center w-full justify-end">
                        <span class="mr-8 p-2 bg-gray-800 rounded-md capitalize text-white">Tag: Eval - End Armand Marechal</span>

                        @auth
                            <div class="relative" x-data="{ dropdownOpen: false }">
                                <button @click="dropdownOpen = !dropdownOpen"
                                    class="my-auto p-2 rounded-md bg-gray-100 focus:outline-none">
                                    <span class="">{{ Auth::user()->fullname }}</span>
                                    <svg class="inline h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                    class="fixed inset-0 h-full w-full z-10"></div>

                                <div x-show="dropdownOpen" x-cloak
                                    class="absolute right-0 top-12 w-48 bg-white rounded-md border border-gray-200 shadow-xl z-20">
                                    <!-- Info -->
                                    <div class="block px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                                        <div>
                                            Alias
                                            <span class="inline font-bold">{{ Auth::user()->name }}</span>
                                        </div>
                                        <div>
                                            Rôle
                                            <span class="inline font-bold">{{ Auth::user()->role->name }}</span>
                                        </div>
                                    </div>

                                    <!-- TODO: add user personal links like profile, settings, etc... -->

                                    <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-blue-500 hover:text-white">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="flex items-center px-3 py-1 my-4 border-2 border-purple-500 hover:border-purple-400 rounded font-semibold text-purple-500 hover:text-purple-400">
                                Se connecter
                            </a>
                            <a href="{{ route('register') }}"
                                class="flex items-center px-3 py-1 ml-2 my-4 border-2 border-purple-500 hover:border-purple-400 rounded font-semibold text-purple-500 hover:text-purple-400">
                                S'inscrire
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="hidden lg:hidden w-full" id="mobile-menu">
            <div class="px-4 py-2 pb-8 space-y-1">
                <x-nav.mobile-link name="Accueil" route="{{ route('home') }}" />
                <x-nav.mobile-dropdown name="Pratiques" route-group="pratice">
                    @can('moderate')
                        <!-- Moderator only all pratices of every states !-->
                        <x-nav.mobile-dropdown-link name="Toutes ~ Modération"
                            route="{{ route('practices.moderation') }}" />
                    @endcan

                    <x-nav.mobile-dropdown-link name="Toutes {{ $domains->sum('practices_count') }}"
                        route="{{ route('practices') }}" />

                    @foreach ($domains as $domain)
                        <x-nav.mobile-dropdown-link name="{!! $domain->name !!} {{ $domain->practices_count }}"
                            route="{{ route('practices.byDomain', ['domain' => $domain->slug]) }}" />
                    @endforeach
                </x-nav.mobile-dropdown>
                <x-nav.mobile-link name="References" route="{{ route('references') }}" />

                <!-- Login !-->
                <div class="flex flex-col md:flex-row w-full border-t text-center ">
                    @auth
                        <!-- User info !-->
                        <div class="flex items-center py-2">
                            <div>
                                <span>Connecté en tant que</span>
                                <span class="font-bold">{{ Auth::user()->fullname }}</span>
                                <span>~</span>
                                <span class="font-bold">{{ Auth::user()->name }}</span>
                                <span>~</span>
                                <span class="font-bold">{{ Auth::user()->role->name }}</span>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="py-2">
                            @csrf
                            <button type="submit"
                                class="w-full px-3 py-2 border-2 border-purple-500 hover:border-purple-400 rounded font-semibold text-purple-500 hover:text-purple-400">
                                Se déconnecter
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full px-3 py-2 mt-4 md:mr-2 border-2 border-purple-500 hover:border-purple-400 rounded font-semibold uppercase text-purple-500 hover:text-purple-400">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}"
                            class="w-full px-3 py-2 mt-4 md:ml-2 border-2 border-purple-500 hover:border-purple-400 rounded font-semibold uppercase text-purple-500 hover:text-purple-400">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>
