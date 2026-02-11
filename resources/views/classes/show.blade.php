<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div
            class="mb-8 flex flex-col md:flex-row items-center justify-between gap-6 bg-slate-800/20 p-8 rounded-3xl border border-slate-700/30 backdrop-blur-md shadow-xl">
            <div class="flex items-center gap-6">
                <div
                    class="w-20 h-20 rounded-2xl bg-emerald-600/20 flex items-center justify-center text-emerald-400 text-3xl shadow-inner">
                    <i class="ti ti-school"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">{{ $class->classes }}</h1>
                    <div class="mt-2 flex items-center gap-3">
                        <span
                            class="px-3 py-1 bg-emerald-600/20 text-emerald-400 border border-emerald-500/20 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                            ID Académico: {{ $class->classes_numeric }}
                        </span>
                        <span class="text-slate-500 font-mono text-xs italic opacity-50">•</span>
                        <span class="text-slate-400 text-sm flex items-center gap-1.5">
                            <i class="ti ti-history text-emerald-500/40"></i>
                            Creado: {{ \Carbon\Carbon::parse($class->create_date)->format('d M, Y') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('classes.edit', $class->classesID) }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20 font-bold text-sm flex items-center justify-center gap-2">
                    <i class="ti ti-edit"></i>
                    Editar
                </a>
                <a href="{{ route('classes.index') }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50 font-bold text-sm flex items-center justify-center">
                    Volver Listado
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Details Column -->
            <div class="md:col-span-2 space-y-8">
                <!-- Administrative Card -->
                <div
                    class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 p-8 text-emerald-500/5 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform">
                        <i class="ti ti-id-badge text-9xl"></i>
                    </div>

                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-clipboard-list text-emerald-400"></i>
                        Detalles Administrativos
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12 relative z-10">
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Responsable
                                Académico</span>
                            <div class="mt-2 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-700/50 flex items-center justify-center text-slate-400">
                                    <i class="ti ti-user-star text-lg"></i>
                                </div>
                                <span
                                    class="text-slate-200 font-bold">{{ $class->teacher_name ?? 'No asignado' }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Identificador
                                Numérico</span>
                            <span
                                class="text-emerald-400 mt-2 block font-mono text-xl font-bold tracking-widest">{{ $class->classes_numeric }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Descripción /
                                Notas</span>
                            <p
                                class="text-slate-200 mt-2 block font-medium leading-relaxed bg-slate-900/30 p-4 rounded-2xl border border-slate-700/30">
                                {{ $class->note ?? 'Sin observaciones adicionales registradas para este nivel académico.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Placeholder for Sections/Students -->
                <div class="p-8 rounded-3xl bg-emerald-600/5 border border-emerald-500/10 backdrop-blur-sm opacity-60">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-layers-subtract text-emerald-400"></i>
                        Secciones y Materias vinculadas
                    </h2>
                    <p class="text-slate-400 italic text-sm text-center py-6">
                        La vinculación dinámica de secciones y materias asociadas a esta clase estará disponible al
                        completar la migración de dichos módulos.
                    </p>
                </div>
            </div>

            <!-- Stats/Actions Sidebar -->
            <div class="space-y-6">
                <!-- Activity Info -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h3
                        class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-6 border-b border-slate-700/30 pb-3">
                        Registro de Sistema</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Usuario Creador</span>
                            <span class="text-slate-200 font-medium">{{ $class->create_username ?? 'System' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">Tipo Usuario</span>
                            <span class="text-slate-200 font-medium">{{ $class->create_usertype ?? 'Admin' }}</span>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-700/30">
                            <span class="text-[10px] text-slate-500 uppercase font-bold block mb-1">Última
                                Modificación</span>
                            <span
                                class="text-xs text-slate-300 font-mono">{{ \Carbon\Carbon::parse($class->modify_date)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div
                    class="p-6 rounded-3xl bg-gradient-to-br from-emerald-600/10 to-transparent border border-emerald-500/20 backdrop-blur-md">
                    <h4 class="text-white font-bold mb-4">Métricas de Clase</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-900/40 p-3 rounded-2xl text-center border border-slate-700/30">
                            <span class="block text-xl font-bold text-emerald-400">--</span>
                            <span
                                class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">Estudiantes</span>
                        </div>
                        <div class="bg-slate-900/40 p-3 rounded-2xl text-center border border-slate-700/30">
                            <span class="block text-xl font-bold text-emerald-400">--</span>
                            <span
                                class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">Secciones</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
