<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Header -->
        <div
            class="mb-8 flex flex-col md:flex-row items-center justify-between gap-6 bg-white dark:bg-slate-800/20 p-8 rounded-3xl border border-slate-200 dark:border-slate-700/30 shadow-sm dark:shadow-none backdrop-blur-md">
            <div class="flex items-center gap-6 text-center md:text-left">
                <div
                    class="w-20 h-20 rounded-2xl bg-indigo-600/10 dark:bg-indigo-600/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-3xl shadow-inner">
                    <i class="ti ti-notebook"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $subject->subject }}
                    </h1>
                    <div class="mt-2 flex items-center gap-3 justify-center md:justify-start">
                        <span
                            class="px-3 py-1 bg-indigo-600/10 dark:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10 dark:border-indigo-500/20 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                            Cód: {{ $subject->subject_code }}
                        </span>
                        <span class="text-slate-200 dark:text-slate-500 font-mono text-xs italic opacity-50">•</span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm flex items-center gap-1.5">
                            <i class="ti ti-school text-indigo-500/40"></i>
                            {{ $subject->class_name }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('subject.edit', $subject->subjectID) }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-amber-500/20 font-bold flex items-center justify-center gap-2 text-sm">
                    <i class="ti ti-edit"></i>
                    Editar
                </a>
                <a href="{{ route('subject.index', ['classesID' => $subject->classesID]) }}"
                    class="flex-1 md:flex-none px-5 py-2.5 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none font-bold flex items-center justify-center text-sm transition-all">
                    Volver Listado
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2 space-y-8">
                <!-- Academic Parameters Card -->
                <div
                    class="p-8 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-sm shadow-xl relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 p-8 text-indigo-500/5 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform">
                        <i class="ti ti-chart-bar text-9xl"></i>
                    </div>

                    <h2
                        class="text-xl font-bold text-slate-900 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700/50 pb-4 flex items-center gap-3">
                        <i class="ti ti-certificate text-indigo-600 dark:text-indigo-400"></i>
                        Parámetros de Calificación
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-10 gap-x-12 relative z-10">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex flex-col items-center justify-center border border-slate-100 dark:border-emerald-500/20 shadow-sm dark:shadow-lg">
                                <span
                                    class="text-[10px] font-bold text-emerald-600 dark:text-emerald-500 uppercase tracking-tighter">MIN</span>
                                <span
                                    class="text-xl font-bold text-emerald-600 dark:text-emerald-400 font-mono">{{ $subject->passmark }}</span>
                            </div>
                            <div>
                                <span
                                    class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-1">Nota
                                    de Aprobación</span>
                                <span class="text-slate-500 dark:text-slate-400 text-[10px]">Criterio mínimo
                                    requerido</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex flex-col items-center justify-center border border-slate-100 dark:border-indigo-500/20 shadow-sm dark:shadow-lg">
                                <span
                                    class="text-[10px] font-bold text-indigo-600 dark:text-indigo-500 uppercase tracking-tighter">MAX</span>
                                <span
                                    class="text-xl font-bold text-indigo-600 dark:text-indigo-400 font-mono">{{ $subject->finalmark }}</span>
                            </div>
                            <div>
                                <span
                                    class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-1">Nota
                                    Final Máxima</span>
                                <span class="text-slate-500 dark:text-slate-400 text-[10px]">Puntaje total de la
                                    materia</span>
                            </div>
                        </div>

                        <div
                            class="sm:col-span-2 p-5 bg-slate-50 dark:bg-slate-900/40 rounded-2xl border border-slate-100 dark:border-slate-700/30 flex items-center justify-between shadow-sm dark:shadow-none">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 border border-slate-100 dark:border-slate-700 shadow-sm dark:shadow-none">
                                    <i class="ti ti-user-star text-lg"></i>
                                </div>
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Titular
                                        de la Asignatura</span>
                                    <span
                                        class="text-slate-700 dark:text-slate-200 font-bold">{{ $subject->teacher_name ?? 'Docente no asignado' }}</span>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-lg text-[10px] font-bold border border-slate-100 dark:border-slate-700 shadow-sm dark:shadow-none uppercase">
                                Responsable
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bibliographic Info -->
                <div
                    class="p-8 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                        <i class="ti ti-book-2 text-indigo-400"></i>
                        Referencia Académica
                    </h2>
                    <div class="flex flex-col gap-4">
                        <div
                            class="p-5 bg-indigo-600/5 rounded-2xl border border-slate-100 dark:border-indigo-500/10 shadow-sm dark:shadow-none">
                            <span
                                class="block text-[10px] font-bold text-indigo-600 dark:text-indigo-500/60 uppercase tracking-widest mb-1">Autor
                                / Editorial</span>
                            <span
                                class="text-slate-600 dark:text-slate-200 font-medium italic">"{{ $subject->subject_author ?? 'Sin referencia bibliográfica registrada' }}"</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="bg-slate-50 dark:bg-slate-900/30 p-4 rounded-xl border border-slate-100 dark:border-slate-700/30 shadow-sm dark:shadow-none">
                                <span
                                    class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1 font-mono">Tipo</span>
                                <span
                                    class="text-slate-700 dark:text-slate-300 font-bold uppercase text-xs">{{ $subject->type == 1 ? 'Obligatoria' : 'Opcional' }}</span>
                            </div>
                            <div
                                class="bg-slate-50 dark:bg-slate-900/30 p-4 rounded-xl border border-slate-100 dark:border-slate-700/30 shadow-sm dark:shadow-none">
                                <span
                                    class="block text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1 font-mono">Código</span>
                                <span
                                    class="text-slate-700 dark:text-slate-300 font-bold uppercase text-xs tracking-widest">{{ $subject->subject_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Stats -->
            <div class="space-y-6">
                <!-- Academic Progress Circle (Visual Only) -->
                <div
                    class="p-8 rounded-3xl bg-white dark:bg-indigo-600/5 border border-slate-200 dark:border-indigo-500/10 shadow-sm dark:shadow-none backdrop-blur-md flex flex-col items-center justify-center text-center">
                    <div class="relative w-24 h-24 mb-4">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="48" cy="48" r="40" stroke="currentColor" stroke-width="8"
                                fill="transparent" class="text-slate-100 dark:text-slate-800" />
                            <circle cx="48" cy="48" r="40" stroke="currentColor" stroke-width="8"
                                fill="transparent" class="text-indigo-500" stroke-dasharray="251.2"
                                stroke-dashoffset="62.8" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-slate-900 dark:text-white">75%</span>
                        </div>
                    </div>
                    <h4 class="text-slate-900 dark:text-white font-bold text-xs uppercase tracking-widest">Aprobación
                        Promedio</h4>
                    <p class="text-slate-500 text-[10px] mt-1 italic">(Dato proyectado)</p>
                </div>

                <!-- Traceability -->
                <div
                    class="p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm space-y-4">
                    <h3
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] border-b border-slate-100 dark:border-slate-700/30 pb-3">
                        Trazabilidad</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-400 dark:text-slate-500 uppercase tracking-widest">Creado</span>
                            <span
                                class="text-slate-700 dark:text-slate-300 font-mono">{{ \Carbon\Carbon::parse($subject->create_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-slate-400 dark:text-slate-500 uppercase tracking-widest">Modificado</span>
                            <span
                                class="text-slate-500 dark:text-slate-300 font-mono">{{ \Carbon\Carbon::parse($subject->modify_date)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
