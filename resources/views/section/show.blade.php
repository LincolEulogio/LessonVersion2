<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div
            class="mb-8 flex flex-col md:flex-row items-center justify-between gap-6 bg-slate-800/20 p-8 rounded-3xl border border-slate-700/30 backdrop-blur-md shadow-xl">
            <div class="flex items-center gap-6 text-center md:text-left">
                <div
                    class="w-20 h-20 rounded-2xl bg-cyan-600/20 flex items-center justify-center text-cyan-400 text-3xl shadow-inner">
                    <i class="ti ti-layers-linked"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">{{ $section->section }}</h1>
                    <div class="mt-2 flex items-center gap-3 justify-center md:justify-start">
                        <span
                            class="px-3 py-1 bg-cyan-600/20 text-cyan-400 border border-cyan-500/20 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                            Clase: {{ $section->class_name }}
                        </span>
                        <span class="text-slate-500 font-mono text-xs italic opacity-50">•</span>
                        <span class="text-slate-400 text-sm flex items-center gap-1.5">
                            <i class="ti ti-tag text-cyan-500/40"></i>
                            {{ $section->category }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('section.edit', $section->sectionID) }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20 font-bold flex items-center justify-center gap-2 text-sm">
                    <i class="ti ti-edit"></i>
                    Editar
                </a>
                <a href="{{ route('section.index', ['classesID' => $section->classesID]) }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl transition-all border border-slate-700/50 font-bold flex items-center justify-center text-sm">
                    Volver Listado
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
            <!-- Details Column -->
            <div class="md:col-span-2 space-y-8">
                <!-- Section Info Card -->
                <div
                    class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 p-8 text-cyan-500/5 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform">
                        <i class="ti ti-users text-9xl"></i>
                    </div>

                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-info-circle text-cyan-400"></i>
                        Información de la Sección
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12 relative z-10">
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Docente
                                Mentor</span>
                            <div class="mt-2 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-700/50 flex items-center justify-center text-slate-400">
                                    <i class="ti ti-user-star text-lg"></i>
                                </div>
                                <span
                                    class="text-slate-200 font-bold">{{ $section->teacher_name ?? 'No asignado' }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Capacidad
                                Autorizada</span>
                            <div class="mt-2 flex items-center gap-3">
                                <span
                                    class="text-2xl font-bold text-cyan-400 tracking-tighter">{{ $section->capacity }}</span>
                                <span class="text-slate-500 font-medium">Estudiantes máx.</span>
                            </div>
                        </div>
                        <div class="sm:col-span-2 text-sm italic">
                            <span
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mt-2 px-1">Notas
                                y Observaciones</span>
                            <p
                                class="text-slate-300 mt-2 block font-medium leading-relaxed bg-slate-900/30 p-5 rounded-2xl border border-slate-700/30">
                                {{ $section->note ?? 'No se han registrado notas específicas para esta sección.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Placeholder for Future Lists -->
                <div class="p-8 rounded-3xl bg-cyan-600/5 border border-cyan-500/10 backdrop-blur-sm opacity-60">
                    <h2
                        class="text-xl font-bold text-white mb-6 border-b border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-users-group text-cyan-400"></i>
                        Estudiantes Inscritos
                    </h2>
                    <p class="text-slate-400 italic text-sm text-center py-6">
                        La lista detallada de estudiantes asignados a esta sección se integrará una vez se complete la
                        migración del módulo de Estudiantes y sus relaciones.
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- System Metadata -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl">
                    <h3
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-6 border-b border-slate-700/30 pb-3">
                        Metadata</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Creado
                                por</span>
                            <span class="text-slate-200 font-medium">{{ $section->create_username ?? 'Sistema' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span
                                class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Modificado</span>
                            <span
                                class="text-slate-300 font-mono">{{ \Carbon\Carbon::parse($section->modify_date)->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Visual Cue for Class -->
                <div
                    class="p-6 rounded-3xl bg-gradient-to-br from-cyan-600/10 to-transparent border border-cyan-500/20 backdrop-blur-md relative overflow-hidden">
                    <i class="ti ti-school absolute -bottom-4 -right-4 text-7xl text-cyan-500/10 rotate-12"></i>
                    <h4 class="text-white font-bold mb-2">Clase Superior</h4>
                    <p class="text-slate-400 text-xs">Esta sección pertenece al nivel académico:</p>
                    <div
                        class="mt-4 p-3 bg-slate-900/50 rounded-xl border border-slate-700/50 text-center font-bold text-cyan-400">
                        {{ $section->class_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
