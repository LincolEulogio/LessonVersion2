<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
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
                <span class="text-slate-300">{{ __('Académico') }}</span>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-emerald-500">{{ __('Calificaciones') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter leading-none">
                        {{ __('Gestión de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Calificaciones') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500/30 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 tracking-[0.3em] uppercase">
                            {{ __('Registro y seguimiento del rendimiento académico por clase') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Auth::user()->hasPermission('porcentaje_promedio_view'))
                        <a href="{{ route('markpercentage.index') }}"
                            class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all shadow-sm flex items-center gap-3">
                            <i class="ti ti-settings text-emerald-500"></i>
                            {{ __('Configurar Porcentajes') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[3rem] shadow-sm overflow-hidden mb-12">
            <form action="{{ route('mark.index') }}" method="GET" class="p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-end">
                    <div class="space-y-4">
                        <label for="classesID"
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                            {{ __('Seleccionar Clase') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-emerald-500 z-10 text-xl"></i>
                            <select name="classesID" id="classesID" onchange="this.form.submit()"
                                class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer">
                                <option value="">{{ __('Seleccione una clase...') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                        {{ $class->classes }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($classesID)
                        <div class="animate-in fade-in slide-in-from-right-4 duration-500">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase">{{ __('Secciones Disponibles') }}</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @forelse($sections as $section)
                                    <a href="{{ route('mark.add', ['classesID' => $classesID, 'sectionID' => $section->sectionID]) }}"
                                        class="group p-5 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl hover:border-emerald-500/50 hover:bg-emerald-500/5 transition-all flex items-center justify-between shadow-sm">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                                <i class="ti ti-section text-xl"></i>
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-slate-700 dark:text-slate-200 font-black uppercase text-xs tracking-wider">
                                                    {{ $section->section }}</h4>
                                                <span
                                                    class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">{{ $section->category }}</span>
                                            </div>
                                        </div>
                                        <i
                                            class="ti ti-arrow-right text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                                    </a>
                                @empty
                                    <p class="text-slate-500 italic text-sm">
                                        {{ __('No hay secciones para esta clase.') }}</p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div
                            class="flex items-center gap-6 p-6 bg-slate-50 dark:bg-slate-900/40 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-800 group transition-all">
                            <div
                                class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 shadow-sm flex items-center justify-center text-slate-300 dark:text-slate-600 group-hover:text-emerald-500 transition-colors">
                                <i class="ti ti-filter text-3xl"></i>
                            </div>
                            <p
                                class="text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-widest leading-relaxed">
                                {{ __('Elija una clase para visualizar las secciones y gestionar las notas.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Global Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6 group hover:translate-y-[-4px] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-3xl bg-blue-500/10 flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform">
                    <i class="ti ti-users text-3xl"></i>
                </div>
                <div>
                    <span
                        class="block text-3xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ \App\Models\Student::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('Estudiantes Totales') }}</span>
                </div>
            </div>

            <div
                class="p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6 group hover:translate-y-[-4px] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-3xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                    <i class="ti ti-notebook text-3xl"></i>
                </div>
                <div>
                    <span
                        class="block text-3xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ \App\Models\Subject::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('Materias Activas') }}</span>
                </div>
            </div>

            <div
                class="p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6 group hover:translate-y-[-4px] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-3xl bg-violet-500/10 flex items-center justify-center text-violet-500 group-hover:scale-110 transition-transform">
                    <i class="ti ti-calendar-event text-3xl"></i>
                </div>
                <div>
                    <span
                        class="block text-3xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ \App\Models\Exam::count() }}</span>
                    <span
                        class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ __('Exámenes Programados') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
