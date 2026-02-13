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
                <a href="{{ route('examschedule.index') }}" class="hover:text-emerald-500 transition-colors">
                    {{ __('Horarios Examen') }}
                </a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Programación Detallada') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Información de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Programación') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500/30 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                            {{ __('Detalles específicos de la sesión de examen') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('examschedule.edit', $schedule->examscheduleID) }}"
                        class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                        <i class="ti ti-pencil mr-2"></i>{{ __('Editar Horario') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Side: Main Details -->
            <div class="md:col-span-2 space-y-8">
                <!-- Exam & Subject Header Card -->
                <div
                    class="bg-white dark:bg-slate-800/40 p-10 rounded-[3rem] border border-slate-200 dark:border-slate-700/50 shadow-sm relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/5 blur-3xl rounded-full"></div>

                    <div class="relative z-10">
                        <div
                            class="flex items-center gap-8 mb-12 pb-12 border-b border-slate-100 dark:border-slate-800">
                            <div
                                class="w-24 h-24 rounded-[2rem] bg-emerald-500 flex items-center justify-center text-white shadow-2xl shadow-emerald-500/30">
                                <i class="ti ti-calendar-event text-5xl"></i>
                            </div>
                            <div>
                                <span
                                    class="text-[11px] font-black text-emerald-500 uppercase tracking-widest block mb-2">{{ $schedule->exam->exam }}</span>
                                <h2
                                    class="text-4xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-tight">
                                    {{ $schedule->subject->subject }}
                                </h2>
                                <p
                                    class="text-slate-500 dark:text-slate-400 font-bold uppercase text-[10px] tracking-widest flex items-center gap-2 mt-2">
                                    <i class="ti ti-school text-emerald-500"></i>
                                    {{ $schedule->classes->classes }} - {{ $schedule->section->section }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                            <!-- Date -->
                            <div class="space-y-3">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">{{ __('Fecha del Examen') }}</span>
                                <div
                                    class="flex items-center gap-4 bg-slate-50 dark:bg-slate-900/50 p-5 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                        <i class="ti ti-calendar text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-900 dark:text-white italic">
                                            {{ \Carbon\Carbon::parse($schedule->edate)->format('d F, Y') }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                            {{ \Carbon\Carbon::parse($schedule->edate)->format('l') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Time -->
                            <div class="space-y-3">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">{{ __('Rango Horario') }}</span>
                                <div
                                    class="flex items-center gap-4 bg-slate-50 dark:bg-slate-900/50 p-5 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                        <i class="ti ti-clock text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-900 dark:text-white italic">
                                            {{ $schedule->examfrom }} - {{ $schedule->examto }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                            {{ __('Duración de sesión') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Room -->
                            <div class="space-y-3 sm:col-span-2">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">{{ __('Ubicación') }}</span>
                                <div
                                    class="flex items-center gap-4 bg-slate-50 dark:bg-slate-900/50 p-5 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                        <i class="ti ti-map-pin text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-900 dark:text-white italic">
                                            {{ $schedule->room ?? __('No asignada') }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                            {{ __('Aula o Salón de clases') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Metadata -->
            <div class="space-y-6">
                <!-- Status Info -->
                <div
                    class="bg-emerald-600 p-10 rounded-[3rem] text-white shadow-2xl shadow-emerald-600/30 relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 opacity-10">
                        <i class="ti ti-bookmark text-9xl"></i>
                    </div>
                    <span
                        class="text-[10px] font-black text-emerald-200 uppercase tracking-widest block mb-4">{{ __('Programación') }}</span>
                    <h3 class="text-3xl font-black italic uppercase mb-2 leading-none">{{ __('Confirmada') }}</h3>
                    <p class="text-emerald-100 text-[10px] font-bold tracking-wider leading-relaxed">
                        Este horario ha sido registrado en el sistema y es visible para docentes y estudiantes
                        vinculados.
                    </p>
                </div>

                <!-- Registration History -->
                <div
                    class="bg-white dark:bg-slate-800/40 p-10 rounded-[3rem] border border-slate-200 dark:border-slate-700/50 shadow-sm relative overflow-hidden">
                    <span
                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-8 px-1">{{ __('Control Interno') }}</span>
                    <div class="space-y-6">
                        <div class="flex items-center gap-5 group">
                            <div
                                class="w-12 h-12 rounded-[1.25rem] bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-400 border border-slate-100 dark:border-slate-800 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                                <i class="ti ti-database-import text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                                    {{ __('Registrado') }}</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                    {{ $schedule->created_at ? $schedule->created_at->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
