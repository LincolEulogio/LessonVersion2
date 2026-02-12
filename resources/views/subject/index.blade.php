<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Plan de Estudios</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Administra las materias, códigos académicos y
                    criterios de aprobación.</p>
            </div>
            <a href="{{ route('subject.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-indigo-600/30 active:scale-95 text-sm">
                <i class="ti ti-notebook text-lg"></i>
                Nueva Materia
            </a>
        </div>

        <!-- Filter Section -->
        <div
            class="mb-8 p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-sm">
            <form action="{{ route('subject.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                <div class="flex-1 space-y-2">
                    <label for="classesID"
                        class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] ml-1">Filtrar por Nivel
                        Académico</label>
                    <div class="relative group">
                        <select name="classesID" id="classesID"
                            class="w-full pl-6 pr-10 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-slate-200 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none appearance-none text-sm"
                            onchange="this.form.submit()">
                            <option value="">Todas las Clases</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                    {{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                            <i class="ti ti-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if ($classesID)
                        <a href="{{ route('subject.index') }}"
                            class="px-5 py-3 text-slate-400 hover:text-white text-sm font-bold transition-colors">
                            Limpiar
                        </a>
                    @endif
                    <button type="submit"
                        class="px-7 py-3 bg-white dark:bg-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold rounded-2xl transition-all border border-slate-200 dark:border-slate-600/30 text-sm">
                        Filtrar Materias
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div
            class="rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-700/50 bg-slate-50 dark:bg-slate-800/50">
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[0.2em]">
                                Código
                            </th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Materia</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Clase
                            </th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Tipo
                            </th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                Min/Max Score</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30 text-sm">
                        @forelse($subjects as $subject)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-indigo-500/5 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-indigo-400 font-bold uppercase tracking-wider text-xs bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">
                                        {{ $subject->subject_code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="font-bold text-slate-800 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-300 transition-colors">
                                        {{ $subject->subject }}
                                    </div>
                                    <div class="text-[10px] text-slate-500 flex items-center gap-1 mt-0.5">
                                        <i class="ti ti-user-star text-xs"></i>
                                        {{ $subject->teacher_name ?? 'Sin Docente' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-slate-600 dark:text-slate-400 font-medium">{{ $subject->class_name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($subject->type == 1)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 text-[10px] font-bold border border-blue-500/20">
                                            <span class="w-1 h-1 bg-blue-400 rounded-full animate-pulse"></span>
                                            OBLIGATORIA
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-slate-700/50 text-slate-400 text-[10px] font-bold border border-slate-600/30">
                                            OPCIONAL
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-mono">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-emerald-600 dark:text-emerald-400/80 font-bold">{{ $subject->passmark }}</span>
                                        <span class="text-slate-300 dark:text-slate-600">/</span>
                                        <span
                                            class="text-slate-800 dark:text-slate-300 font-bold">{{ $subject->finalmark }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                        <a href="{{ route('subject.show', $subject->subjectID) }}"
                                            class="p-2 bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded-lg transition-all"
                                            title="Configuración">
                                            <i class="ti ti-settings"></i>
                                        </a>
                                        <a href="{{ route('subject.edit', $subject->subjectID) }}"
                                            class="p-2 bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white rounded-lg transition-all"
                                            title="Editar">
                                            <i class="ti ti-edit-circle"></i>
                                        </a>
                                        <form action="{{ route('subject.destroy', $subject->subjectID) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('¿Eliminar esta materia del plan de estudios?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Eliminar">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-16 h-16 rounded-full bg-slate-800/80 flex items-center justify-center border border-slate-700/50">
                                            <i class="ti ti-book-off text-3xl text-slate-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Sin
                                                Contenido Académico</p>
                                            <p class="text-slate-600 text-[10px] mt-1 italic">No hay materias
                                                registradas para este nivel aún.</p>
                                        </div>
                                        <a href="{{ route('subject.create') }}"
                                            class="px-5 py-2 bg-indigo-600/20 text-indigo-400 rounded-xl hover:bg-indigo-600 hover:text-white transition-all border border-indigo-500/20 text-[10px] font-bold tracking-widest uppercase mt-2">
                                            Registrar Materia
                                        </a>
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
