<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-8 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2">
                    <i class="ti ti-smart-home text-sm"></i>
                    {{ __('Dashboard') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('exam.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Exámenes') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ $exam->exam }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Detalles del') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Examen') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500/30 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                            {{ __('Información detallada de la evaluación') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('exam.edit', $exam->examID) }}"
                        class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
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
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/5 blur-3xl rounded-full"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-10">
                            <div
                                class="w-20 h-20 rounded-3xl bg-emerald-500 flex items-center justify-center text-white shadow-xl shadow-emerald-500/20">
                                <i class="ti ti-file-certificate text-4xl"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] font-black text-emerald-500 uppercase tracking-widest block mb-1">{{ __('Identificador') }}</span>
                                <h2
                                    class="text-3xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight">
                                    {{ $exam->exam }}</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                            <div class="space-y-2">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">{{ __('Fecha Programada') }}</span>
                                <div
                                    class="flex items-center gap-4 bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                    <i class="ti ti-calendar text-2xl text-emerald-500 font-bold"></i>
                                    <div>
                                        <p class="text-slate-900 dark:text-white font-black italic">
                                            {{ \Carbon\Carbon::parse($exam->date)->format('l, d F Y') }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                            {{ __('Fecha de evaluación') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($exam->note)
                            <div class="space-y-4">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-1">{{ __('Observaciones') }}</span>
                                <div class="bg-amber-500/[0.03] border-l-4 border-amber-500 p-6 rounded-r-3xl italic">
                                    <p class="text-slate-600 dark:text-slate-400 font-medium leading-relaxed">
                                        "{{ $exam->note }}"
                                    </p>
                                </div>
                            </div>
                        @else
                            <div
                                class="py-10 text-center bg-slate-50 dark:bg-slate-900/40 rounded-[2rem] border-2 border-dashed border-slate-100 dark:border-slate-700/50">
                                <i class="ti ti-notes-off text-3xl text-slate-300 mb-3"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    {{ __('Sin observaciones adicionales') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats/Actions Side -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div
                    class="bg-emerald-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-emerald-600/20 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-10">
                        <i class="ti ti-circle-check text-8xl"></i>
                    </div>
                    <span
                        class="text-[10px] font-black text-emerald-200 uppercase tracking-widest block mb-4">{{ __('Estado del Examen') }}</span>
                    <h4 class="text-2xl font-black italic uppercase mb-2">{{ __('Activo') }}</h4>
                    <p class="text-emerald-100 text-[10px] font-bold tracking-wider leading-relaxed">
                        Esta evaluación está disponible para ser vinculada a horarios y registros de asistencia.
                    </p>
                </div>

                <!-- Registration History Card -->
                <div
                    class="bg-white dark:bg-slate-800/40 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-6 px-1">{{ __('Registro de Sistema') }}</span>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-400 border border-slate-100 dark:border-slate-800 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                                <i class="ti ti-clock-up text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                                    {{ __('Creado el') }}</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-200">
                                    {{ $exam->created_at ? $exam->created_at->format('d/m/Y H:i') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-400 border border-slate-100 dark:border-slate-800 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                                <i class="ti ti-refresh text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                                    {{ __('Última Modif.') }}</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-200">
                                    {{ $exam->updated_at ? $exam->updated_at->format('d/m/Y H:i') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
