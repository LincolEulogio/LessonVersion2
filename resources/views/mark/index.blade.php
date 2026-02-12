<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Registro de Calificaciones
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Gestione las notas y evaluaciones académicas por
                    periodo.</p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 bg-orange-600/10 dark:bg-orange-500/10 border border-orange-500/10 dark:border-orange-500/20 rounded-xl text-orange-600 dark:text-orange-400 text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 bg-orange-600 dark:bg-orange-500 rounded-full animate-pulse"></span>
                    Módulo Académico
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden mb-8">
            <form action="{{ route('mark.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="space-y-2">
                        <label for="classesID"
                            class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">Seleccionar
                            Clase</label>
                        <select name="classesID" id="classesID" onchange="this.form.submit()"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-4 py-3 text-slate-700 dark:text-slate-200 focus:border-orange-500/50 focus:ring-4 focus:ring-orange-500/10 transition-all outline-none cursor-pointer">
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
                                    <a href="{{ route('mark.add', ['classesID' => $classesID, 'sectionID' => $section->sectionID]) }}"
                                        class="group p-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/50 rounded-2xl hover:border-orange-500/50 hover:bg-orange-500/5 transition-all flex items-center gap-4 shadow-sm hover:shadow-none">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-orange-600/10 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:scale-110 transition-transform">
                                            <i class="ti ti-section text-xl"></i>
                                        </div>
                                        <div>
                                            <h4
                                                class="text-slate-700 dark:text-slate-200 font-bold group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors uppercase tracking-wider text-sm">
                                                {{ $section->section }}</h4>
                                            <span
                                                class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">{{ $section->category }}</span>
                                        </div>
                                        <i
                                            class="ti ti-chevron-right ml-auto text-slate-300 dark:text-slate-700 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors"></i>
                                    </a>
                                @empty
                                    <p class="text-slate-500 italic text-sm">No hay secciones para esta clase.</p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div
                            class="p-6 bg-slate-50 dark:bg-slate-900/30 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                            <i class="ti ti-filter text-3xl text-slate-300 dark:text-slate-700 mb-2"></i>
                            <p class="text-slate-400 dark:text-slate-500 text-xs font-medium">Seleccione una clase para
                                iniciar la gestión.
                            </p>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-blue-600/10 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-sm">
                    <i class="ti ti-users text-2xl"></i>
                </div>
                <div>
                    <span
                        class="block text-2xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Student::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Estudiantes</span>
                </div>
            </div>

            <div
                class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-emerald-600/10 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
                    <i class="ti ti-notebook text-2xl"></i>
                </div>
                <div>
                    <span
                        class="block text-2xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Subject::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Materias</span>
                </div>
            </div>

            <div
                class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-violet-600/10 dark:bg-violet-500/10 flex items-center justify-center text-violet-600 dark:text-violet-400 shadow-sm">
                    <i class="ti ti-calendar-event text-2xl"></i>
                </div>
                <div>
                    <span
                        class="block text-2xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Exam::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">Exámenes</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
