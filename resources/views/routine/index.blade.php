<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter">Horarios Escolares</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Programación semanal de bases académicas.
                </p>
            </div>
            <a href="{{ route('routine.create') }}"
                class="inline-flex items-center gap-3 px-8 py-4 bg-[#6366f1] hover:bg-[#585af2] text-white font-bold rounded-[2rem] transition-all transform hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-[#6366f1]/30">
                <i class="ti ti-calendar-plus text-xl"></i>
                Agregar Horario
            </a>
        </div>

        <!-- Filter Bar -->
        <div
            class="mb-10 p-8 rounded-[2.5rem] bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 backdrop-blur-3xl">
            <form action="{{ route('routine.index') }}" method="GET" class="flex flex-wrap items-end gap-6">
                <div class="flex-1 min-w-[280px] space-y-3">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] pl-1">Filtrar
                        por Nivel Académico</label>
                    <select name="classesID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-[#6366f1] py-3 px-4">
                        <option value="">Todos los Grados</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Schedule Table -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/10 border border-slate-200 dark:border-slate-700/30 overflow-hidden backdrop-blur-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-800/40 border-b border-slate-100 dark:border-slate-700/50">
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em]">
                                Día</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em]">
                                Clase/Sección</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em]">
                                Materia / Docente</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em]">
                                Hora y Aula</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em] text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/20">
                        @forelse($routines as $routine)
                            <tr
                                class="group hover:bg-slate-50/80 dark:hover:bg-[#6366f1]/5 transition-all duration-300">
                                <td class="px-8 py-8">
                                    <span
                                        class="px-4 py-1.5 bg-[#6366f1]/10 text-[#6366f1] text-[11px] font-black uppercase tracking-widest rounded-full">
                                        {{ __($routine->day) }}
                                    </span>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="font-black text-slate-900 dark:text-slate-100">
                                        {{ $routine->class_name }}</div>
                                    <div class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">Sección
                                        {{ $routine->section_name }}</div>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-10 bg-indigo-500 rounded-full"></div>
                                        <div>
                                            <div class="font-black text-slate-800 dark:text-slate-200">
                                                {{ $routine->subject_name }}</div>
                                            <div
                                                class="text-[11px] font-bold text-slate-500 dark:text-slate-400 mt-0.5">
                                                {{ $routine->teacher_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-300 font-black">
                                        <i class="ti ti-clock-filled text-[#6366f1]"></i>
                                        {{ $routine->start_time }} - {{ $routine->end_time }}
                                    </div>
                                    <div
                                        class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest flex items-center gap-1">
                                        <i class="ti ti-map-pin"></i> Aula: {{ $routine->room }}
                                    </div>
                                </td>
                                <td class="px-8 py-8 text-right">
                                    <div
                                        class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all scale-95 group-hover:scale-100">
                                        <a href="{{ route('routine.edit', $routine->routineID) }}"
                                            class="w-10 h-10 flex items-center justify-center bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-2xl transition-all">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('routine.destroy', $routine->routineID) }}"
                                            method="POST" class="inline" onsubmit="return confirm('¿Borrar horario?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 flex items-center justify-center bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-2xl transition-all">
                                                <i class="ti ti-trash-x text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-[2rem] flex items-center justify-center">
                                            <i class="ti ti-calendar-off text-4xl text-slate-300"></i>
                                        </div>
                                        <p class="text-slate-500 dark:text-slate-400 font-bold tracking-tight">No hay
                                            horarios programados para este filtro.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
