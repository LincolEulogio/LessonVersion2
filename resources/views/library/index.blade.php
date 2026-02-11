<x-app-layout>
    <div class="min-h-screen bg-[#0f172a] text-white font-sans selection:bg-blue-500/30">
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1
                        class="text-3xl font-bold bg-linear-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">
                        📚 Panel de Biblioteca
                    </h1>
                    <p class="mt-2 text-slate-400">Resumen y accesos directos del sistema de biblioteca.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span
                        class="px-4 py-2 rounded-xl bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm text-sm font-medium flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Sistema Activo
                    </span>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Books -->
                <div
                    class="p-6 rounded-2xl bg-linear-to-br from-blue-500/10 to-transparent border border-blue-500/20 backdrop-blur-xl group hover:border-blue-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Libros en Total</p>
                            <h3 class="text-3xl font-bold mt-1 text-blue-400">{{ number_format($stats['total_books']) }}
                            </h3>
                        </div>
                        <div
                            class="p-3 bg-blue-500/20 rounded-xl text-blue-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-books text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('book.index') }}"
                            class="text-xs text-blue-400 hover:text-blue-300 flex items-center gap-1 font-medium transition-colors">
                            Ver inventario <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Members -->
                <div
                    class="p-6 rounded-2xl bg-linear-to-br from-purple-500/10 to-transparent border border-purple-500/20 backdrop-blur-xl group hover:border-purple-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Miembros Activos</p>
                            <h3 class="text-3xl font-bold mt-1 text-purple-400">
                                {{ number_format($stats['total_members']) }}</h3>
                        </div>
                        <div
                            class="p-3 bg-purple-500/20 rounded-xl text-purple-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-users text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('lmember.index') }}"
                            class="text-xs text-purple-400 hover:text-purple-300 flex items-center gap-1 font-medium transition-colors">
                            Gestionar miembros <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Issued Books -->
                <div
                    class="p-6 rounded-2xl bg-linear-to-br from-orange-500/10 to-transparent border border-orange-500/20 backdrop-blur-xl group hover:border-orange-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Libros Prestados</p>
                            <h3 class="text-3xl font-bold mt-1 text-orange-400">
                                {{ number_format($stats['total_issued']) }}</h3>
                        </div>
                        <div
                            class="p-3 bg-orange-500/20 rounded-xl text-orange-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-book-upload text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('issue.index') }}"
                            class="text-xs text-orange-400 hover:text-orange-300 flex items-center gap-1 font-medium transition-colors">
                            Ver préstamos <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Completed Returns -->
                <div
                    class="p-6 rounded-2xl bg-linear-to-br from-emerald-500/10 to-transparent border border-emerald-500/20 backdrop-blur-xl group hover:border-emerald-500/40 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Devoluciones</p>
                            <h3 class="text-3xl font-bold mt-1 text-emerald-400">
                                {{ number_format($stats['total_returns']) }}</h3>
                        </div>
                        <div
                            class="p-3 bg-emerald-500/20 rounded-xl text-emerald-400 group-hover:scale-110 transition-transform">
                            <i class="ti ti-book-check text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-500 font-medium">
                        Histórico completo
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Short-cuts -->
                <div
                    class="lg:col-span-2 rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm p-8 shadow-xl">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="ti ti-bolt text-yellow-400"></i> Acciones Rápidas
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('issue.create') }}"
                            class="p-5 rounded-xl bg-slate-900/50 border border-slate-700 hover:border-blue-500/50 hover:bg-slate-800 transition-all group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="p-3 rounded-lg bg-blue-500/10 text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-all">
                                    <i class="ti ti-bookmark-plus text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-slate-200">Nuevo Préstamo</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Registrar salida de libro</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('book.create') }}"
                            class="p-5 rounded-xl bg-slate-900/50 border border-slate-700 hover:border-indigo-500/50 hover:bg-slate-800 transition-all group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="p-3 rounded-lg bg-indigo-500/10 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                                    <i class="ti ti-plus text-xl"></i>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-slate-200">Añadir Libro</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Ingresar nuevo ejemplar</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div
                    class="rounded-2xl bg-linear-to-br from-indigo-600/20 to-blue-600/10 border border-indigo-500/20 backdrop-blur-sm p-8 shadow-xl flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold mb-4">Módulo de Biblioteca</h2>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Este módulo permite llevar un control estricto del inventario bibliográfico y el flujo de
                            préstamos a estudiantes y personal docente.
                        </p>
                    </div>
                    <div class="mt-8">
                        <div class="flex items-center -space-x-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-full border-2 border-slate-800 bg-blue-500 flex items-center justify-center text-xs font-bold">
                                L</div>
                            <div
                                class="w-10 h-10 rounded-full border-2 border-slate-800 bg-indigo-500 flex items-center justify-center text-xs font-bold">
                                B</div>
                            <div
                                class="w-10 h-10 rounded-full border-2 border-slate-800 bg-cyan-500 flex items-center justify-center text-xs font-bold">
                                M</div>
                        </div>
                        <p class="text-xs text-slate-500 font-medium">Migración Phase 12 completada.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
