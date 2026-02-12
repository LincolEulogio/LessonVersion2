<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('report.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Informe de Clase</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Genera listados de alumnos por
                        grado y sección</p>
                </div>
            </div>

            @if (count($students) > 0)
                <button onclick="window.print()"
                    class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.02] active:scale-95 flex items-center gap-2">
                    <i class="ti ti-printer text-lg"></i> Imprimir Reporte
                </button>
            @endif
        </div>

        <!-- Filter Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-8 mb-8 shadow-sm print:hidden">
            <form action="{{ route('report.class') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Seleccionar
                        Clase</label>
                    <select name="classesID" id="classesID" onchange="this.form.submit()" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        <option value="">Seleccione Clase</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Sección</label>
                    <select name="sectionID" id="sectionID" onchange="this.form.submit()"
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        <option value="">Todas las secciones</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->sectionID }}"
                                {{ $sectionID == $section->sectionID ? 'selected' : '' }}>{{ $section->section }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-4">
                    <button type="submit"
                        class="flex-1 px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/30">
                        Generar Informe
                    </button>
                    <a href="{{ route('report.class') }}"
                        class="px-8 py-3.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 font-black text-xs uppercase tracking-widest transition-all">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        @if ($classesID)
            <!-- Report Table -->
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] overflow-hidden shadow-sm">
                <div
                    class="p-8 border-b border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                            Listado de Estudiantes - {{ $classes->find($classesID)->classes }}
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">
                            @if ($sectionID)
                                Sección: {{ $sections->find($sectionID)->section }}
                            @else
                                Todas las secciones
                            @endif
                        </p>
                    </div>
                    <div
                        class="px-6 py-2 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-black uppercase tracking-widest border border-indigo-100 dark:border-indigo-500/20">
                        Total: {{ count($students) }} Alumnos
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr
                                class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700/50">
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Roll</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Estudiante</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Sección</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Correo</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                            @forelse($students as $student)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors group">
                                    <td class="px-8 py-5 text-sm font-black text-indigo-600 dark:text-indigo-400">
                                        {{ str_pad($student->roll, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            @if ($student->photo)
                                                <img src="{{ asset('uploads/images/' . $student->photo) }}"
                                                    class="w-10 h-10 rounded-xl object-cover border border-slate-200 dark:border-slate-600">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-black text-xs">
                                                    {{ substr($student->name, 0, 2) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div
                                                    class="text-sm font-black text-slate-900 dark:text-white capitalize tracking-tight">
                                                    {{ $student->name }}</div>
                                                <div
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                    {{ $student->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="px-3 py-1 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                                            {{ $student->section->section }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-sm font-medium text-slate-500 dark:text-slate-400">
                                        {{ $student->email }}</td>
                                    <td class="px-8 py-5 text-right">
                                        <a href="{{ route('report.student', ['classesID' => $student->classesID, 'studentID' => $student->studentID]) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-[10px] font-black text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:border-indigo-600/30 transition-all uppercase tracking-widest">
                                            <i class="ti ti-user-circle text-base"></i> Ver Perfil
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-4">
                                            <i class="ti ti-users text-3xl"></i>
                                        </div>
                                        <p class="text-slate-500 dark:text-slate-400 font-bold">No se encontraron
                                            estudiantes para este filtro.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div
                class="bg-white dark:bg-slate-800/30 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-[40px] p-20 text-center">
                <div
                    class="w-24 h-24 rounded-[32px] bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mx-auto mb-6 shadow-inner">
                    <i class="ti ti-filter text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Configura los filtros</h3>
                <p class="text-slate-500 dark:text-slate-400 font-medium mt-2 max-w-sm mx-auto">Selecciona una clase y
                    sección en el panel superior para generar el informe de estudiantes.</p>
            </div>
        @endif
    </div>
</x-app-layout>
