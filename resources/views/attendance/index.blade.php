<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Control de Asistencia</h1>
                <p class="text-slate-400 mt-1">Gestione la puntualidad y asistencia de los estudiantes.</p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 bg-rose-500/10 border border-rose-500/20 rounded-xl text-rose-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></span>
                    Módulo de Registro
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl overflow-hidden shadow-2xl mb-8">
            <form action="{{ route('attendance.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="space-y-2">
                        <label for="classesID"
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Seleccionar
                            Clase</label>
                        <select name="classesID" id="classesID" onchange="this.form.submit()"
                            class="w-full bg-slate-900/50 border border-slate-700/50 rounded-2xl px-4 py-3 text-slate-200 focus:border-rose-500/50 focus:ring-4 focus:ring-rose-500/10 transition-all outline-none cursor-pointer">
                            <option value="">Seleccione una clase...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if ($classesID)
                        <div class="animate-in fade-in slide-in-from-bottom-4 duration-500">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($sections as $section)
                                    <a href="{{ route('attendance.add', ['classesID' => $classesID, 'sectionID' => $section->sectionID]) }}"
                                        class="group p-4 bg-slate-900/50 border border-slate-700/50 rounded-2xl hover:border-rose-500/50 hover:bg-rose-500/5 transition-all flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-rose-500/10 flex items-center justify-center text-rose-400 group-hover:scale-110 transition-transform">
                                            <i class="ti ti-section text-xl"></i>
                                        </div>
                                        <div>
                                            <h4
                                                class="text-slate-200 font-bold group-hover:text-rose-400 transition-colors uppercase tracking-wider text-sm">
                                                {{ $section->section }}</h4>
                                            <span
                                                class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $section->category }}</span>
                                        </div>
                                        <i
                                            class="ti ti-chevron-right ml-auto text-slate-700 group-hover:text-rose-400 transition-colors"></i>
                                    </a>
                                @empty
                                    <p class="text-slate-500 italic text-sm">No hay secciones para esta clase.</p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div
                            class="p-6 bg-slate-900/30 rounded-2xl border border-dashed border-slate-700/50 flex flex-col items-center justify-center text-center">
                            <i class="ti ti-filter text-3xl text-slate-700 mb-2"></i>
                            <p class="text-slate-500 text-xs font-medium">Seleccione una clase para ver sus secciones
                                disponibles.</p>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Quick Stats / Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="p-6 rounded-3xl bg-emerald-500/5 border border-emerald-500/10 backdrop-blur-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400">
                    <i class="ti ti-clock-check text-xl"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-white">Diaria</span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Modo Actual</span>
                </div>
            </div>

            <div
                class="p-6 rounded-3xl bg-indigo-500/5 border border-indigo-500/10 backdrop-blur-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                    <i class="ti ti-calendar-stats text-xl"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-white">{{ date('d M') }}</span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Fecha Hoy</span>
                </div>
            </div>

            <div
                class="p-6 rounded-3xl bg-amber-500/5 border border-amber-500/10 backdrop-blur-sm flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400">
                    <i class="ti ti-info-circle text-xl"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-white">Asistencia</span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Sistema
                        Académico</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
