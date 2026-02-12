<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-[#0b1120] dark:text-slate-200 selection:bg-indigo-500/30 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-[#0f172a] border-r border-slate-200 dark:border-slate-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
            @include('layouts.navigation')
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header
                class="h-16 flex items-center justify-between px-6 bg-white/90 dark:bg-[#0f172a]/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button id="toggle-sidebar"
                        class="lg:hidden p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-800 transition-colors">
                        <i class="ti ti-menu-2 text-xl"></i>
                    </button>
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Academic Year -->
                    <div
                        class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-indigo-500/10 text-indigo-400 rounded-lg border border-indigo-500/20">
                        <i class="ti ti-calendar-event text-lg"></i>
                        <span class="text-xs font-bold uppercase tracking-wider">Año Lectivo: 2026</span>
                    </div>

                    <!-- Language Switcher -->
                    <div class="relative group">
                        <button
                            class="p-2 rounded-lg text-slate-400 hover:text-indigo-400 hover:bg-indigo-400/10 transition-all flex items-center gap-1">
                            <i class="ti ti-language text-xl"></i>
                            <span class="text-xs font-bold uppercase">{{ app()->getLocale() }}</span>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-32 bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl py-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all z-50">
                            <a href="{{ route('lang.switch', 'es') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <span class="w-5 text-center">🇪🇸</span> Español
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                <span class="w-5 text-center">🇺🇸</span> English
                            </a>
                        </div>
                    </div>

                    <!-- Theme Switcher -->
                    <button id="theme-toggle"
                        class="p-2 rounded-lg text-slate-400 hover:text-yellow-400 hover:bg-yellow-400/10 transition-all"
                        title="Cambiar Tema">
                        <i id="theme-icon" class="ti ti-moon text-xl"></i>
                    </button>

                    <!-- Notifications -->
                    <button
                        class="relative p-2 rounded-lg text-slate-400 hover:text-indigo-400 hover:bg-indigo-400/10 transition-all"
                        title="Notificaciones">
                        <i class="ti ti-bell text-xl"></i>
                        <span
                            class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-[#0f172a]"></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-3 px-3 py-1.5 bg-slate-100 dark:bg-slate-800/50 rounded-full border border-slate-200 dark:border-slate-700/50 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all">
                            <span
                                class="hidden sm:inline text-sm font-bold text-slate-600 dark:text-slate-300">{{ Auth::user()->name }}</span>
                            <div
                                class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-black text-xs uppercase shadow-sm">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-56 origin-top-right divide-y divide-slate-100 dark:divide-slate-800 rounded-2xl bg-white dark:bg-[#0f172a] shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden border border-slate-200 dark:border-slate-800"
                            x-cloak>
                            <div class="px-4 py-4 bg-slate-50/50 dark:bg-slate-800/20">
                                <p
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                    Conectado como</p>
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                                    {{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                    class="group flex items-center px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    <i
                                        class="ti ti-user-circle text-lg mr-3 text-slate-400 group-hover:text-indigo-500"></i>
                                    Ver Perfil
                                </a>
                                <a href="{{ route('profile.edit') }}#update-password"
                                    class="group flex items-center px-4 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    <i class="ti ti-lock text-lg mr-3 text-slate-400 group-hover:text-indigo-500"></i>
                                    Contraseña
                                </a>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="group flex w-full items-center px-4 py-2.5 text-sm font-medium text-rose-500 hover:bg-rose-500/10 transition-colors">
                                        <i class="ti ti-logout text-lg mr-3 opacity-70"></i>
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main
                class="flex-1 overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
                <div class="max-w-[1600px] mx-auto space-y-6">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <footer class="mt-12 py-6 border-t border-slate-200 dark:border-slate-800/50 text-center">
                    <p class="text-sm text-slate-500">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Lesson') }}. Todos los derechos reservados.
                    </p>
                </footer>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            };

            toggleBtn?.addEventListener('click', toggleSidebar);
            overlay?.addEventListener('click', toggleSidebar);

            // Theme Toggle Logic
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const htmlElement = document.documentElement;

            const applyTheme = (theme) => {
                if (theme === 'dark') {
                    htmlElement.classList.add('dark');
                    themeIcon.classList.replace('ti-sun', 'ti-moon');
                    localStorage.setItem('theme', 'dark');
                } else {
                    htmlElement.classList.remove('dark');
                    themeIcon.classList.replace('ti-moon', 'ti-sun');
                    localStorage.setItem('theme', 'light');
                }
            };

            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)')
                .matches ? 'dark' : 'light');
            applyTheme(savedTheme);

            themeToggle?.addEventListener('click', () => {
                applyTheme(htmlElement.classList.contains('dark') ? 'light' : 'dark');
            });
        });
    </script>
</body>

</html>
