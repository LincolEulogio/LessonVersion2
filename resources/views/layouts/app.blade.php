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

<body class="font-sans antialiased bg-[#0b1120] text-slate-200 selection:bg-indigo-500/30 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0f172a] border-r border-slate-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
            @include('layouts.navigation')
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header
                class="h-16 flex items-center justify-between px-6 bg-[#0f172a]/80 backdrop-blur-md border-b border-slate-800 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button id="toggle-sidebar"
                        class="lg:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                        <i class="ti ti-menu-2 text-xl"></i>
                    </button>
                    <h2 class="text-lg font-semibold text-slate-100">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Right side header items like Search, Notifications, User Profile -->
                    <div
                        class="hidden sm:flex items-center gap-3 px-3 py-1.5 bg-slate-800/50 rounded-full border border-slate-700/50">
                        <span class="text-sm font-medium text-slate-300">{{ Auth::user()->name }}</span>
                        <div
                            class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="p-2 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition-colors"
                            title="{{ __('Log Out') }}">
                            <i class="ti ti-logout text-xl"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main
                class="flex-1 overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
                <div class="max-w-[1600px] mx-auto space-y-6">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <footer class="mt-12 py-6 border-t border-slate-800/50 text-center">
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
        });
    </script>
</body>

</html>
