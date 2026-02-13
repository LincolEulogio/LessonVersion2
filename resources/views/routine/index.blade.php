<x-app-layout>
    @php
        $dayNames = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $dayColors = [
            'Monday' =>
                'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20',
            'Tuesday' =>
                'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:border-indigo-500/20',
            'Wednesday' =>
                'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
            'Thursday' =>
                'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
            'Friday' =>
                'bg-sky-50 text-sky-600 border-sky-100 dark:bg-sky-500/10 dark:text-sky-400 dark:border-sky-500/20',
            'Saturday' =>
                'bg-violet-50 text-violet-600 border-violet-100 dark:bg-violet-500/10 dark:text-violet-400 dark:border-violet-500/20',
            'Sunday' =>
                'bg-slate-50 text-slate-600 border-slate-100 dark:bg-slate-500/10 dark:text-slate-400 dark:border-slate-500/20',
        ];
    @endphp

    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Dashboard Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex items-center gap-3 text-slate-400 mb-2">
                    <i class="ti ti-smart-home text-lg"></i>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span class="text-xs font-black uppercase tracking-[0.2em]">{{ __('Académico') }}</span>
                    <i class="ti ti-chevron-right text-xs"></i>
                    <span
                        class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Horarios') }}</span>
                </nav>
                <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                    {{ __('Horarios de Clase') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-tighter">
                    {{ __('Gestión de rutinas diarias, aulas y asignación de docentes') }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('routine.create') }}"
                    class="group relative flex items-center gap-3 bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all shadow-lg shadow-emerald-500/20 hover:scale-[1.02] active:scale-95">
                    <i class="ti ti-calendar-plus text-xl transition-transform group-hover:rotate-12"></i>
                    {{ __('Nuevo Horario') }}
                </a>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
            <div
                class="lg:col-span-3 bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-3xl p-6 shadow-sm">
                <form action="{{ route('routine.index') }}" method="GET"
                    class="flex flex-col md:flex-row items-end gap-4">
                    <div class="flex-1 w-full space-y-2">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Filtrar por Clase') }}</label>
                        <div class="relative group">
                            <i
                                class="ti ti-school absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors z-10"></i>
                            <select name="classesID" onchange="this.form.submit()"
                                class="w-full pl-12 pr-10 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none appearance-none cursor-pointer font-bold">
                                <option value="">{{ __('Todas las Clases') }}</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->classesID }}"
                                        {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                        {{ $class->classes }}
                                    </option>
                                @endforeach
                            </select>
                            <i
                                class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div class="flex-1 w-full space-y-2">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Búsqueda') }}</label>
                        <div class="relative group">
                            <i
                                class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="{{ __('Aula, docente o día...') }}"
                                class="w-full pl-12 pr-6 py-3.5 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none font-bold">
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-slate-900 dark:bg-white dark:text-slate-900 text-white p-4 rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-xl shadow-slate-900/10 shrink-0">
                        <i class="ti ti-adjustments-horizontal text-xl"></i>
                    </button>

                    @if ($classesID || $search)
                        <a href="{{ route('routine.index') }}"
                            class="bg-rose-500 text-white p-4 rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-xl shadow-rose-500/20 shrink-0"
                            title="{{ __('Limpiar Filtros') }}">
                            <i class="ti ti-trash-x text-xl"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div
                class="bg-emerald-600 rounded-3xl p-6 text-white shadow-lg shadow-emerald-600/20 relative overflow-hidden group">
                <i
                    class="ti ti-clock-hour-4 absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:scale-110 transition-transform"></i>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">{{ __('Total Sesiones') }}</p>
                <h3 class="text-4xl font-black mt-2">{{ $routines->total() }}</h3>
                <div class="mt-4">
                    <span
                        class="px-2 py-0.5 bg-white/20 rounded-md text-[10px] font-black uppercase italic">{{ __('Semana Actual') }}</span>
                </div>
            </div>
        </div>

        <!-- Routines Table Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] shadow-sm dark:shadow-none overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700/50">
                            <th class="px-10 py-6 text-left">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Día') }}</span>
                            </th>
                            <th class="px-6 py-6 text-left">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Horario / Aula') }}</span>
                            </th>
                            <th
                                class="px-6 py-6 text-left uppercase tracking-widest font-black text-[10px] text-slate-400">
                                {{ __('Clase & Materia') }}
                            </th>
                            <th
                                class="px-6 py-6 text-left uppercase tracking-widest font-black text-[10px] text-slate-400">
                                {{ __('Docente Responsable') }}
                            </th>
                            <th class="px-10 py-6 text-right">
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('Acciones') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-sm">
                        @forelse($routines as $routine)
                            <tr
                                class="group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all duration-300">
                                <td class="px-10 py-6">
                                    <span
                                        class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border {{ $dayColors[$routine->day] ?? $dayColors['Sunday'] }} shadow-sm">
                                        {{ __($dayNames[$routine->day] ?? $routine->day) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 font-mono">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200">
                                            <i class="ti ti-clock text-emerald-500 text-base"></i>
                                            <span class="font-black text-sm">{{ $routine->start_time }} -
                                                {{ $routine->end_time }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-slate-400">
                                            <i class="ti ti-door-enter text-base"></i>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-widest">{{ __('AULA:') }}
                                                {{ $routine->room }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-md text-[10px] font-black uppercase tracking-tighter border border-indigo-100 dark:border-indigo-500/20">
                                                {{ $routine->class_name }} - {{ $routine->section_name }}
                                            </span>
                                        </div>
                                        <span
                                            class="font-black text-slate-700 dark:text-slate-200 uppercase text-xs tracking-tight">{{ $routine->subject_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-white dark:bg-slate-800 rounded-xl flex items-center justify-center text-slate-400 border border-slate-200 dark:border-slate-700 shadow-sm group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all group-hover:rotate-3">
                                            <i class="ti ti-user-star text-xl"></i>
                                        </div>
                                        <span
                                            class="font-black text-slate-700 dark:text-slate-200 text-sm italic">{{ $routine->teacher_name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('routine.show', $routine->routineID) }}"
                                            class="w-10 h-10 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 transition-all shadow-sm border border-indigo-100/50 dark:border-indigo-500/20"
                                            title="{{ __('Ver Detalles') }}">
                                            <i class="ti ti-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('routine.edit', $routine->routineID) }}"
                                            class="w-10 h-10 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center hover:bg-amber-500 hover:text-white dark:hover:bg-amber-500 transition-all shadow-sm border border-amber-100/50 dark:border-amber-500/20"
                                            title="{{ __('Editar') }}">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button
                                            onclick="confirmDelete('{{ $routine->routineID }}', '{{ $routine->subject_name }}')"
                                            class="w-10 h-10 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white dark:hover:bg-rose-500 transition-all shadow-sm border border-rose-100/50 dark:border-rose-500/20"
                                            title="{{ __('Eliminar') }}">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                        <form id="delete-form-{{ $routine->routineID }}"
                                            action="{{ route('routine.destroy', $routine->routineID) }}"
                                            method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-4">
                                        <div
                                            class="w-32 h-32 bg-slate-50 dark:bg-slate-900/50 rounded-[40px] flex items-center justify-center text-slate-200 dark:text-slate-700 shadow-inner border border-slate-100 dark:border-slate-800">
                                            <i class="ti ti-calendar-off text-7xl"></i>
                                        </div>
                                        <div class="max-w-xs mx-auto">
                                            <h3
                                                class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                                {{ __('Horario Vacío') }}</h3>
                                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                                                {{ __('No se encontraron rutinas para los filtros seleccionados. Comience por agregar una nueva sesión.') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if ($routines->hasPages())
                <div
                    class="px-10 py-8 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row items-center justify-between gap-6 uppercase">
                    <div class="flex flex-col md:flex-row items-center gap-3">
                        <span
                            class="text-[10px] font-black text-slate-400 tracking-[0.2em]">{{ __('Mostrando') }}</span>
                        <div class="flex items-center gap-2">
                            <span
                                class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-xs font-black text-emerald-600 border border-slate-200 dark:border-slate-700 shadow-sm">{{ $routines->firstItem() ?? 0 }}</span>
                            <span class="text-slate-300 dark:text-slate-700">—</span>
                            <span
                                class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-xs font-black text-emerald-600 border border-slate-200 dark:border-slate-700 shadow-sm">{{ $routines->lastItem() ?? 0 }}</span>
                        </div>
                        <span
                            class="text-[10px] font-black text-slate-400 tracking-[0.2em]">{{ __('de') }}</span>
                        <span
                            class="text-sm font-black text-slate-900 dark:text-white">{{ $routines->total() }}</span>
                        <span
                            class="text-[10px] font-black text-emerald-500 tracking-[0.2em]">{{ __('Sesiones Totales') }}</span>
                    </div>
                    <div class="premium-pagination">
                        {{ $routines->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id, title) {
                Swal.fire({
                    title: '¿ELIMINAR HORARIO?',
                    text: `Vas a borrar el horario de la materia "${title}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    iconColor: '#f43f5e',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#f43f5e',
                    confirmButtonText: 'SÍ, ELIMINAR',
                    cancelButtonText: 'CANCELAR',
                    background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                    borderRadius: '40px',
                    customClass: {
                        popup: 'border border-slate-200 dark:border-slate-700 shadow-2xl backdrop-blur-xl',
                        title: 'text-2xl font-black tracking-tight mt-4',
                        htmlContainer: 'text-sm font-medium leading-relaxed opacity-70',
                        confirmButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] transition-all hover:scale-105 active:scale-95 m-2',
                        cancelButton: 'rounded-2xl px-8 py-4 font-black uppercase text-[10px] tracking-[0.2em] m-2 transition-all hover:scale-105 active:scale-95'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
