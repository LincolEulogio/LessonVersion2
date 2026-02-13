<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('dashboard') }}" class="hover:text-amber-500 transition-colors flex items-center gap-2">
                    <i class="ti ti-smart-home text-sm"></i>
                    {{ __('Dashboard') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('grade.index') }}" class="hover:text-amber-500 transition-colors">
                    {{ __('Escalas Evaluación') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-amber-500">{{ $grade->grade }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Detalles de') }} <span class="text-amber-500 relative inline-block">
                            {{ __('Escala') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-amber-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-amber-500/30 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                            {{ __('Configuración de niveles de rendimiento') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('grade.edit', $grade->gradeID) }}"
                        class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                        <i class="ti ti-pencil mr-2"></i>{{ __('Editar') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="md:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-800/40 p-10 rounded-[3rem] border border-slate-200 dark:border-slate-700/50 shadow-sm relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/5 blur-3xl rounded-full"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-12">
                            <div
                                class="w-20 h-20 rounded-3xl bg-amber-500 flex items-center justify-center text-white shadow-xl shadow-amber-500/20">
                                <span class="text-4xl font-black italic tracking-tighter">{{ $grade->grade }}</span>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] font-black text-amber-500 uppercase tracking-widest block mb-1">{{ __('Calificación') }}</span>
                                <h2
                                    class="text-3xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight">
                                    {{ $grade->grade }}</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
                            <div class="space-y-2">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">{{ __('Punto de Grado') }}</span>
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700/50 flex flex-col items-center">
                                    <p
                                        class="text-5xl font-black text-slate-900 dark:text-white italic tracking-tighter leading-none">
                                        {{ number_format((float) $grade->point, 2) }}
                                    </p>
                                    <span
                                        class="text-xs font-black text-amber-500 uppercase mt-2 tracking-widest">{{ __('Points') }}</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">{{ __('Rango de Porcentaje') }}</span>
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 p-6 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                    <div class="flex justify-between items-center mb-4">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] font-black text-slate-400 uppercase">{{ __('Desde') }}</span>
                                            <span
                                                class="text-lg font-black text-slate-900 dark:text-white">{{ $grade->markfrom }}%</span>
                                        </div>
                                        <i class="ti ti-arrow-right text-amber-500"></i>
                                        <div class="flex flex-col items-end">
                                            <span
                                                class="text-[9px] font-black text-slate-400 uppercase">{{ __('Hasta') }}</span>
                                            <span
                                                class="text-lg font-black text-slate-900 dark:text-white">{{ $grade->markto }}%</span>
                                        </div>
                                    </div>
                                    <div class="h-2 w-full bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                        <div style="width: {{ $grade->markfrom }}%" class="h-full bg-transparent">
                                        </div>
                                        <div style="width: {{ $grade->markto - $grade->markfrom }}%"
                                            class="h-full bg-amber-500 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($grade->note)
                            <div class="space-y-4">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">{{ __('Comentarios') }}</span>
                                <div class="bg-amber-500/[0.03] border-l-4 border-amber-500 p-6 rounded-r-3xl italic">
                                    <p class="text-slate-600 dark:text-slate-400 font-medium leading-relaxed">
                                        "{{ $grade->note }}"
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Side Card -->
            <div class="space-y-6">
                <div
                    class="bg-amber-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-amber-600/20 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10">
                        <i class="ti ti-award text-8xl"></i>
                    </div>
                    <span
                        class="text-[10px] font-black text-amber-200 uppercase tracking-widest block mb-4">{{ __('Impacto Académico') }}</span>
                    <h4 class="text-2xl font-black italic uppercase mb-2">{{ __('Nivel Definido') }}</h4>
                    <p class="text-amber-100 text-[10px] font-bold tracking-wider leading-relaxed">
                        Esta escala define cómo se traducen los puntajes numéricos en calificaciones cualitativas dentro
                        del sistema.
                    </p>
                </div>

                <div
                    class="bg-white dark:bg-slate-800/40 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-6 px-1">{{ __('Historial') }}</span>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-400 border border-slate-100 dark:border-slate-800 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                <i class="ti ti-clock-up text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                                    {{ __('Creado') }}</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-200">
                                    {{ $grade->created_at ? $grade->created_at->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
