<x-app-layout>
    <x-slot name="header">
        <span
            class="bg-linear-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent group-hover:from-indigo-300 group-hover:to-purple-300 transition-all duration-300">
            {{ __('Dashboard') }}
        </span>
    </x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Students Card -->
        <div
            class="p-6 rounded-2xl bg-rose-500 shadow-lg group hover:scale-[1.02] transition-all duration-300 overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="ti ti-school text-9xl text-white"></i>
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-white/80 text-sm font-semibold uppercase tracking-wider">{{ __('Estudiantes') }}</p>
                    <h3 class="text-4xl font-extrabold text-white mt-1">1,284</h3>
                </div>
                <div class="p-3 bg-white/20 rounded-xl text-white backdrop-blur-md">
                    <i class="ti ti-school text-3xl"></i>
                </div>
            </div>
            <div
                class="mt-4 flex items-center gap-2 text-xs text-white/90 font-medium relative z-10 bg-white/10 w-fit px-2 py-1 rounded-full backdrop-blur-sm">
                <i class="ti ti-trending-up"></i>
                <span>+12% vs {{ __('mes pasado') }}</span>
            </div>
        </div>

        <!-- Parents Card -->
        <div
            class="p-6 rounded-2xl bg-emerald-500 shadow-lg group hover:scale-[1.02] transition-all duration-300 overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="ti ti-users text-9xl text-white"></i>
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-white/80 text-sm font-semibold uppercase tracking-wider">{{ __('Padres') }}</p>
                    <h3 class="text-4xl font-extrabold text-white mt-1">942</h3>
                </div>
                <div class="p-3 bg-white/20 rounded-xl text-white backdrop-blur-md">
                    <i class="ti ti-users text-3xl"></i>
                </div>
            </div>
            <div
                class="mt-4 flex items-center gap-2 text-xs text-white/90 font-medium relative z-10 bg-white/10 w-fit px-2 py-1 rounded-full backdrop-blur-sm">
                <i class="ti ti-circle-check"></i>
                <span>{{ __('Asistencia completa') }}</span>
            </div>
        </div>

        <!-- Teachers Card -->
        <div
            class="p-6 rounded-2xl bg-amber-500 shadow-lg group hover:scale-[1.02] transition-all duration-300 overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="ti ti-user-bolt text-9xl text-white"></i>
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-white/80 text-sm font-semibold uppercase tracking-wider">{{ __('Docentes') }}</p>
                    <h3 class="text-4xl font-extrabold text-white mt-1">84</h3>
                </div>
                <div class="p-3 bg-white/20 rounded-xl text-white backdrop-blur-md">
                    <i class="ti ti-user-bolt text-3xl"></i>
                </div>
            </div>
            <div
                class="mt-4 flex items-center gap-2 text-xs text-white/90 font-medium relative z-10 bg-white/10 w-fit px-2 py-1 rounded-full backdrop-blur-sm">
                <i class="ti ti-clock"></i>
                <span>98% {{ __('puntualidad') }}</span>
            </div>
        </div>

        <!-- Subjects Card -->
        <div
            class="p-6 rounded-2xl bg-indigo-500 shadow-lg group hover:scale-[1.02] transition-all duration-300 overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="ti ti-book text-9xl text-white"></i>
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-white/80 text-sm font-semibold uppercase tracking-wider">{{ __('Materias') }}</p>
                    <h3 class="text-4xl font-extrabold text-white mt-1">126</h3>
                </div>
                <div class="p-3 bg-white/20 rounded-xl text-white backdrop-blur-md">
                    <i class="ti ti-book text-3xl"></i>
                </div>
            </div>
            <div
                class="mt-4 flex items-center gap-2 text-xs text-white/90 font-medium relative z-10 bg-white/10 w-fit px-2 py-1 rounded-full backdrop-blur-sm">
                <i class="ti ti-layout-grid"></i>
                <span>{{ __('Plan de estudios activo') }}</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Income Chart Placeholder -->
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-sm overflow-hidden">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                    <i class="ti ti-chart-area-line text-indigo-400"></i>
                    {{ __('Resumen de Cuentas') }}
                </h3>
                <div class="flex gap-2">
                    <span class="flex items-center gap-1 text-[10px] text-emerald-400"><span
                            class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Ingresos</span>
                    <span class="flex items-center gap-1 text-[10px] text-red-400"><span
                            class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Egresos</span>
                </div>
            </div>
            <div class="h-64 flex items-end gap-3 relative">
                <!-- Simple bar chart CSS simulation -->
                @for ($i = 0; $i < 12; $i++)
                    <div class="flex-1 bg-indigo-500/20 rounded-t-lg relative group transition-all duration-500 hover:bg-indigo-500/40"
                        style="height: {{ rand(30, 90) }}%">
                        <div
                            class="absolute inset-x-1 bottom-0 bg-indigo-500 rounded-t-sm transition-all duration-700 h-1/2 group-hover:h-3/4">
                        </div>
                    </div>
                @endfor
                <div class="absolute inset-x-0 bottom-0 h-px bg-slate-700"></div>
            </div>
            <div class="mt-4 flex justify-between text-[10px] text-slate-500">
                <span>Ene</span><span>Feb</span><span>Mar</span><span>Abr</span><span>May</span><span>Jun</span><span>Jul</span><span>Ago</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dic</span>
            </div>
        </div>

        <!-- Attendance Chart Placeholder -->
        <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-sm overflow-hidden">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                    <i class="ti ti-chart-donut text-purple-400"></i>
                    {{ __('Estadísticas del Año') }}
                </h3>
                <select
                    class="bg-slate-900/50 border-slate-700 text-slate-400 text-xs rounded-lg focus:ring-indigo-500 py-1">
                    <option>2026</option>
                    <option>2025</option>
                </select>
            </div>
            <div class="h-64 relative flex items-center justify-center">
                <!-- Circular SVG decoration representing data -->
                <svg viewBox="0 0 100 100" class="w-48 h-48 transform -rotate-90">
                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8"
                        fill="transparent" class="text-slate-700/30" />
                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8"
                        fill="transparent" stroke-dasharray="251.2" stroke-dashoffset="60" class="text-indigo-500"
                        stroke-linecap="round" />
                    <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="8"
                        fill="transparent" class="text-slate-700/30" />
                    <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="8"
                        fill="transparent" stroke-dasharray="188.4" stroke-dashoffset="40" class="text-purple-500"
                        stroke-linecap="round" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-2xl font-bold text-white">94%</span>
                    <span class="text-[10px] text-slate-500 uppercase tracking-widest">{{ __('Promedio') }}</span>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded bg-indigo-500"></div>
                    <span class="text-xs text-slate-400">Académico (85%)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded bg-purple-500"></div>
                    <span class="text-xs text-slate-400">Asistencia (94%)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-sm mb-8">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-bold text-slate-100 flex items-center gap-2 lowercase">
                <i class="ti ti-calendar-event text-emerald-400"></i>
                <span class="capitalize">{{ now()->translatedFormat('F Y') }}</span>
            </h3>
            <div class="flex gap-1 bg-slate-900/50 p-1 rounded-xl border border-slate-800">
                <button
                    class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-white transition-colors rounded-lg">{{ __('Semana') }}</button>
                <button
                    class="px-4 py-2 text-xs font-bold text-white bg-indigo-600 rounded-lg shadow-lg">{{ __('Mes') }}</button>
                <button
                    class="px-4 py-2 text-xs font-bold text-slate-400 hover:text-white transition-colors rounded-lg">{{ __('Agenda') }}</button>
            </div>
        </div>

        <div class="grid grid-cols-7 border-b border-slate-800 pb-4 mb-4">
            @foreach (['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                <div class="text-center">
                    <span
                        class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ $day }}</span>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 gap-px bg-slate-800/50 rounded-xl overflow-hidden border border-slate-800">
            @php
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                $startDay = $startOfMonth->dayOfWeek == 0 ? 6 : $startOfMonth->dayOfWeek - 1;
                $daysInMonth = $startOfMonth->daysInMonth;
                $today = now()->day;
            @endphp

            @for ($i = 0; $i < $startDay; $i++)
                <div class="h-28 bg-[#0f172a]/30"></div>
            @endfor

            @for ($day = 1; $day <= $daysInMonth; $day++)
                <div class="h-28 bg-[#0f172a]/50 p-2 relative group hover:bg-[#1e293b]/50 transition-colors">
                    <span
                        class="text-sm font-bold {{ $day == $today ? 'bg-indigo-600 text-white w-7 h-7 flex items-center justify-center rounded-lg shadow-lg shadow-indigo-600/30' : 'text-slate-400 group-hover:text-slate-200' }}">
                        {{ $day }}
                    </span>

                    @if ($day == $today)
                        <div class="mt-2 space-y-1">
                            <div
                                class="px-2 py-0.5 rounded bg-indigo-500/20 border-l-2 border-indigo-500 text-[9px] text-indigo-400 font-bold truncate">
                                Reunión Directivo
                            </div>
                        </div>
                    @elseif($day == $today + 4)
                        <div class="mt-2 space-y-1">
                            <div
                                class="px-2 py-0.5 rounded bg-emerald-500/20 border-l-2 border-emerald-500 text-[9px] text-emerald-400 font-bold truncate">
                                Examen Mate
                            </div>
                        </div>
                    @endif
                </div>
            @endfor

            @php
                $remainingSlots = 42 - ($startDay + $daysInMonth);
            @endphp
            @for ($i = 0; $i < $remainingSlots; $i++)
                <div class="h-28 bg-[#0f172a]/30"></div>
            @endfor
        </div>
    </div>
</x-app-layout>
