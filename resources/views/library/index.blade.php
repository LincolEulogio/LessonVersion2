<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-white dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-slate-200 dark:border-blue-500/20 shadow-sm dark:shadow-none">
                    <i class="ti ti-library text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        Panel de Biblioteca
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Gestión centralizada de
                        recursos bibliográficos</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 rounded-2xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl flex items-center gap-3 transition-all hover:border-blue-500/30 group">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span
                        class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Sistema
                        Activo</span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Books -->
            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-blue-500/50">
                <div
                    class="absolute -right-8 -bottom-8 w-24 h-24 bg-blue-500/5 dark:bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all">
                </div>

                <div
                    class="flex justify-between items-start relative pb-4 border-b border-slate-50 dark:border-slate-700/30 mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-500/20 shadow-sm">
                        <i class="ti ti-books text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            Inventario</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ number_format($stats['total_books']) }}</h3>
                    </div>
                </div>
                <a href="{{ route('book.index') }}" class="flex items-center justify-between group/link">
                    <span
                        class="text-xs font-bold text-slate-500 dark:text-slate-400 group-hover/link:text-blue-600 dark:group-hover/link:text-blue-400 transition-colors uppercase tracking-wider">Ver
                        Libros</span>
                    <i
                        class="ti ti-chevron-right text-slate-300 dark:text-slate-700 group-hover/link:text-blue-600 dark:group-hover/link:text-blue-400 transition-all transform group-hover/link:translate-x-1"></i>
                </a>
            </div>

            <!-- Total Members -->
            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-purple-500/50">
                <div
                    class="absolute -right-8 -bottom-8 w-24 h-24 bg-purple-500/5 dark:bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all">
                </div>

                <div
                    class="flex justify-between items-start relative pb-4 border-b border-slate-50 dark:border-slate-700/30 mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-500/20 shadow-sm">
                        <i class="ti ti-users text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            Membresías</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ number_format($stats['total_members']) }}</h3>
                    </div>
                </div>
                <a href="{{ route('lmember.index') }}" class="flex items-center justify-between group/link">
                    <span
                        class="text-xs font-bold text-slate-500 dark:text-slate-400 group-hover/link:text-purple-600 dark:group-hover/link:text-purple-400 transition-colors uppercase tracking-wider">Gestionar</span>
                    <i
                        class="ti ti-chevron-right text-slate-300 dark:text-slate-700 group-hover/link:text-purple-600 dark:group-hover/link:text-purple-400 transition-all transform group-hover/link:translate-x-1"></i>
                </a>
            </div>

            <!-- Issued Books -->
            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-orange-500/50">
                <div
                    class="absolute -right-8 -bottom-8 w-24 h-24 bg-orange-500/5 dark:bg-orange-500/10 rounded-full blur-2xl group-hover:bg-orange-500/20 transition-all">
                </div>

                <div
                    class="flex justify-between items-start relative pb-4 border-b border-slate-50 dark:border-slate-700/30 mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-orange-50 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-orange-100 dark:border-orange-500/20 shadow-sm">
                        <i class="ti ti-book-upload text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            En Préstamo</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ number_format($stats['total_issued']) }}</h3>
                    </div>
                </div>
                <a href="{{ route('issue.index') }}" class="flex items-center justify-between group/link">
                    <span
                        class="text-xs font-bold text-slate-500 dark:text-slate-400 group-hover/link:text-orange-600 dark:group-hover/link:text-orange-400 transition-colors uppercase tracking-wider">Ver
                        Salidas</span>
                    <i
                        class="ti ti-chevron-right text-slate-300 dark:text-slate-700 group-hover/link:text-orange-600 dark:group-hover/link:text-orange-400 transition-all transform group-hover/link:translate-x-1"></i>
                </a>
            </div>

            <!-- Completed Returns -->
            <div
                class="group p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl relative overflow-hidden transition-all hover:border-emerald-500/50">
                <div
                    class="absolute -right-8 -bottom-8 w-24 h-24 bg-emerald-500/5 dark:bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all">
                </div>

                <div
                    class="flex justify-between items-start relative pb-4 border-b border-slate-50 dark:border-slate-700/30 mb-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                        <i class="ti ti-book-check text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">
                            Entregados</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            {{ number_format($stats['total_returns']) }}</h3>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span
                        class="text-[10px] font-black text-slate-300 dark:text-slate-700 uppercase tracking-widest">Histórico
                        Completo</span>
                    <i class="ti ti-archive text-slate-200 dark:text-slate-800"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Info -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Short-cuts -->
            <div
                class="lg:col-span-2 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl p-8 shadow-sm dark:shadow-none">
                <h2
                    class="font-black text-slate-900 dark:text-white mb-8 flex items-center gap-3 uppercase tracking-tight text-sm">
                    <i class="ti ti-bolt text-yellow-500"></i> Acciones Rápidas
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <a href="{{ route('issue.create') }}"
                        class="group p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700 hover:border-blue-500/50 hover:bg-white dark:hover:bg-slate-800 transition-all shadow-sm hover:shadow-none">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all">
                                <i class="ti ti-bookmark-plus text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-sm">
                                    Nuevo Préstamo</p>
                                <p
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1">
                                    Registrar salida de libro</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('book.create') }}"
                        class="group p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700 hover:border-indigo-500/50 hover:bg-white dark:hover:bg-slate-800 transition-all shadow-sm hover:shadow-none">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="ti ti-plus text-2xl"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-black text-slate-900 dark:text-white uppercase tracking-tight text-sm">
                                    Añadir Libro</p>
                                <p
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1">
                                    Ingresar nuevo ejemplar</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Info Illustration Card -->
            <div
                class="rounded-3xl bg-linear-to-br from-blue-600 to-indigo-700 p-8 shadow-xl shadow-blue-900/20 flex flex-col justify-between relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32 group-hover:bg-white/20 transition-all">
                </div>

                <div class="relative">
                    <h2 class="font-black text-white mb-4 uppercase tracking-tight text-sm flex items-center gap-2">
                        <i class="ti ti-info-circle"></i> Info Académica
                    </h2>
                    <p class="text-blue-100/80 leading-relaxed text-sm font-medium">
                        Control exhaustivo del inventario bibliográfico y flujo de préstamos automatizado para optimizar
                        los recursos escolares.
                    </p>
                </div>

                <div class="mt-12 relative">
                    <div class="flex items-center -space-x-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-2xl border-4 border-blue-600 bg-white dark:bg-slate-800 flex items-center justify-center text-blue-600 font-black shadow-lg">
                            L</div>
                        <div
                            class="w-12 h-12 rounded-2xl border-4 border-blue-600 bg-blue-400 flex items-center justify-center text-white font-black shadow-lg">
                            B</div>
                        <div
                            class="w-12 h-12 rounded-2xl border-4 border-blue-600 bg-indigo-500 flex items-center justify-center text-white font-black shadow-lg">
                            S</div>
                    </div>
                    <div class="flex items-center justify-between border-t border-white/10 pt-4">
                        <span class="text-[10px] font-black text-blue-200 uppercase tracking-widest">Library Suite
                            v2.0</span>
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-300/40"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-300/40"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
