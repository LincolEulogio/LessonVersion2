<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-calendar-event text-rose-500"></i>
                    Horario de Exámenes
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Programación cronológica de evaluaciones
                    por nivel académico.</p>
            </div>
            <a href="{{ route('examschedule.create') }}"
                class="inline-flex items-center gap-3 px-8 py-4 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-[2rem] transition-all transform hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-rose-500/30">
                <i class="ti ti-plus text-xl"></i>
                Programar Examen
            </a>
        </div>

        <!-- Filter Card -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden mb-10">
            <form action="{{ route('examschedule.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                    <div class="space-y-3">
                        <label for="classesID"
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-2">Filtrar
                            por Clase</label>
                        <select name="classesID" id="classesID" onchange="this.form.submit()"
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-6 py-4 text-slate-700 dark:text-slate-200 font-bold focus:border-rose-500/50 focus:ring-4 focus:ring-rose-500/10 transition-all outline-none cursor-pointer">
                            <option value="">Seleccione una clase...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-start">
                        @if ($classesID)
                            <div
                                class="px-6 py-4 bg-rose-500/10 rounded-2xl border border-rose-500/20 text-rose-500 text-xs font-black uppercase tracking-widest flex items-center gap-3">
                                <i class="ti ti-filter-check text-lg"></i>
                                Filtro Activo
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Schedule View -->
        @if ($classesID)
            <div
                class="rounded-[3rem] bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-900/40">
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                    Examen</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                    Materia</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                    Fecha</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                    Horario</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                    Aula</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] text-right">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                            @forelse($schedules as $schedule)
                                <tr class="group hover:bg-rose-500/5 transition-all duration-300">
                                    <td
                                        class="px-8 py-6 font-black text-slate-800 dark:text-slate-100 uppercase tracking-tight">
                                        {{ $schedule->exam->exam }}</td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $schedule->subject->subject }}</span>
                                            <span
                                                class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $schedule->section->section }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2 text-rose-500 font-bold">
                                            <i class="ti ti-calendar-event"></i>
                                            {{ \Carbon\Carbon::parse($schedule->edate)->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="px-3 py-1 bg-slate-100 dark:bg-slate-700 rounded-lg text-[11px] font-black text-slate-600 dark:text-slate-400 inline-flex items-center gap-2">
                                            <i class="ti ti-clock"></i>
                                            {{ $schedule->examfrom }} - {{ $schedule->examto }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ $schedule->room ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('examschedule.edit', $schedule->examscheduleID) }}"
                                                class="p-2.5 bg-white dark:bg-slate-800 rounded-xl text-slate-400 hover:text-rose-500 shadow-sm border border-slate-100 dark:border-slate-700 transition-all">
                                                <i class="ti ti-edit text-lg"></i>
                                            </a>
                                            <form
                                                action="{{ route('examschedule.destroy', $schedule->examscheduleID) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Seguro de eliminar este horario?')">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="p-2.5 bg-white dark:bg-slate-800 rounded-xl text-slate-400 hover:text-rose-600 shadow-sm border border-slate-100 dark:border-slate-700 transition-all">
                                                    <i class="ti ti-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <i class="ti ti-calendar-x text-5xl text-slate-200 mb-4 block"></i>
                                        <p class="text-slate-500 font-medium italic">No hay exámenes programados para
                                            esta clase.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div
                class="py-20 text-center rounded-[3rem] border-4 border-dashed border-slate-100 dark:border-slate-800/30 bg-slate-50/30 dark:bg-slate-900/10">
                <i class="ti ti-layers-intersect text-6xl text-slate-200 mb-6 block"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Selección Requerida</h3>
                <p class="text-slate-500 max-w-sm mx-auto mt-2 text-sm font-medium">Por favor elige una clase para
                    visualizar la programación detallada de sus exámenes.</p>
            </div>
        @endif
    </div>
</x-app-layout>
