<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-slate-400 mb-6">
                <a href="{{ route('dashboard') }}"
                    class="hover:text-emerald-500 transition-colors flex items-center gap-2 group">
                    <i class="ti ti-smart-home text-xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ __('Dashboard') }}</span>
                </a>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500/60">{{ __('Académico') }}</span>
                <i class="ti ti-chevron-right text-[10px]"></i>
                <span
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500">{{ __('Horarios Examen') }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1
                        class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-none">
                        {{ __('Horarios de') }} <span class="text-emerald-500 relative inline-block">
                            {{ __('Exámenes') }}
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-emerald-500/20 rounded-full"></span>
                        </span>
                    </h1>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] flex items-center gap-3">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                        {{ __('Programación cronológica de evaluaciones por nivel') }}
                    </p>
                </div>

                @if (Auth::user()->hasPermission('horario_de_examen_add'))
                    <div class="flex items-center gap-4">
                        <a href="{{ route('examschedule.create') }}"
                            class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[2rem] shadow-xl shadow-emerald-500/20 transition-all flex items-center gap-3 font-black text-[11px] uppercase tracking-widest group">
                            <i class="ti ti-plus text-lg group-hover:rotate-90 transition-transform duration-300"></i>
                            {{ __('Programar Examen') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
                });
            </script>
        @endif

        <!-- Filter Card -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-xl overflow-hidden mb-10 group/card">
            <form action="{{ route('examschedule.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                    <div class="space-y-3">
                        <label for="classesID"
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 group-focus-within/card:text-emerald-500 transition-colors">
                            {{ __('Filtrar por Clase') }}
                        </label>
                        <div class="relative">
                            <i
                                class="ti ti-school absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/card:text-emerald-500 transition-colors z-10 text-lg"></i>
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
                        <div class="flex items-center gap-3">
                            <div
                                class="px-6 py-4 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 text-emerald-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-3 animate-fade-in">
                                <i class="ti ti-filter-check text-lg"></i>
                                {{ __('Filtro Activo') }}
                            </div>
                            <a href="{{ route('examschedule.index') }}"
                                class="text-[10px] font-black text-slate-400 hover:text-rose-500 uppercase tracking-widest transition-colors">
                                {{ __('Limpiar') }}
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Schedule View -->
        @if ($classesID)
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 rounded-[3rem] shadow-sm backdrop-blur-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-900/40">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Examen') }}</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Materia / Sección') }}</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Fecha') }}</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Horario') }}</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    {{ __('Aula') }}</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                    {{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @forelse($schedules as $schedule)
                                <tr class="group hover:bg-emerald-500/5 transition-all duration-300">
                                    <td class="px-8 py-6">
                                        <a href="{{ route('exam.show', $schedule->examID) }}" class="group/link">
                                            <span
                                                class="text-sm font-black text-slate-900 dark:text-white uppercase italic tracking-tight group-hover/link:text-emerald-500 transition-colors">{{ $schedule->exam->exam }}</span>
                                        </a>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $schedule->subject->subject }}</span>
                                            <span
                                                class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ $schedule->section->section }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="flex items-center gap-2 text-slate-600 dark:text-slate-400 font-bold text-sm">
                                            <i class="ti ti-calendar-event text-emerald-500"></i>
                                            {{ \Carbon\Carbon::parse($schedule->edate)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="px-4 py-1.5 bg-slate-100 dark:bg-slate-900/50 rounded-lg text-[10px] font-black text-slate-600 dark:text-slate-400 inline-flex items-center gap-2 border border-slate-200 dark:border-slate-700/50">
                                            <i class="ti ti-clock text-emerald-500"></i>
                                            {{ $schedule->examfrom }} - {{ $schedule->examto }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-sm font-bold text-slate-500 dark:text-slate-400">
                                        {{ $schedule->room ?? 'N/A' }}
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div
                                            class="flex justify-end gap-2 @if (!Auth::user()->hasPermission('horario_de_examen_edit') && !Auth::user()->hasPermission('horario_de_examen_delete')) opacity-100 @else opacity-0 group-hover:opacity-100 @endif transition-opacity">
                                            <a href="{{ route('examschedule.show', $schedule->examscheduleID) }}"
                                                class="w-10 h-10 rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-emerald-500 transition-all">
                                                <i class="ti ti-eye text-lg"></i>
                                            </a>
                                            @if (Auth::user()->hasPermission('horario_de_examen_edit'))
                                                <a href="{{ route('examschedule.edit', $schedule->examscheduleID) }}"
                                                    class="w-10 h-10 rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-emerald-500 transition-all">
                                                    <i class="ti ti-pencil text-lg"></i>
                                                </a>
                                            @endif
                                            @if (Auth::user()->hasPermission('horario_de_examen_delete'))
                                                <button type="button"
                                                    onclick="confirmDelete('{{ $schedule->examscheduleID }}', '{{ $schedule->exam->exam }}')"
                                                    class="w-10 h-10 rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-rose-500 transition-all">
                                                    <i class="ti ti-trash text-lg"></i>
                                                </button>
                                                <form id="delete-form-{{ $schedule->examscheduleID }}"
                                                    action="{{ route('examschedule.destroy', $schedule->examscheduleID) }}"
                                                    method="POST" class="hidden">
                                                    @csrf @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div
                                            class="w-20 h-20 bg-slate-50 dark:bg-slate-900 rounded-[2rem] flex items-center justify-center text-slate-300 mx-auto mb-4">
                                            <i class="ti ti-calendar-x text-4xl"></i>
                                        </div>
                                        <p
                                            class="text-slate-400 font-black uppercase tracking-[0.2em] text-[10px] italic">
                                            {{ __('No hay exámenes programados para esta clase.') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div
                class="py-24 text-center rounded-[3rem] border-4 border-dashed border-slate-100 dark:border-slate-800/50 bg-slate-50/20 dark:bg-slate-900/10">
                <div
                    class="w-24 h-24 bg-white dark:bg-slate-800 shadow-xl rounded-[2.5rem] flex items-center justify-center text-slate-200 mx-auto mb-8 rotate-3">
                    <i class="ti ti-layers-intersect text-5xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight">
                    {{ __('Selección Requerida') }}</h3>
                <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto mt-4 text-sm font-medium leading-relaxed">
                    {{ __('Por favor elige una clase para visualizar la programación detallada de sus exámenes.') }}
                </p>
            </div>
        @endif
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: '¿Eliminar horario?',
                text: `Vas a eliminar la programación para "${name}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
