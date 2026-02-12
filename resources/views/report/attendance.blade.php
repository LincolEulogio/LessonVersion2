<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('report.index') }}"
                    class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-slate-400 dark:text-slate-500 hover:text-emerald-600 dark:hover:text-white transition-all shadow-sm flex items-center justify-center group">
                    <i class="ti ti-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Informe de Asistencia
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Análisis de presencia y
                        puntualidad escolar</p>
                </div>
            </div>

            @if (count($reportData) > 0)
                <button onclick="window.print()"
                    class="px-6 py-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-black text-xs uppercase tracking-widest transition-all shadow-lg flex items-center gap-2">
                    <i class="ti ti-printer text-lg"></i> Imprimir Reporte
                </button>
            @endif
        </div>

        <!-- Filter Card -->
        <div
            class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[32px] p-8 mb-8 shadow-sm print:hidden">
            <form action="{{ route('report.attendance') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">
                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Clase</label>
                    <select name="classesID" id="classesID" onchange="this.form.submit()" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
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
                    <select name="sectionID" id="sectionID" onchange="this.form.submit()" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold">
                        <option value="">Seleccione Sección</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->sectionID }}"
                                {{ $sectionID == $section->sectionID ? 'selected' : '' }}>{{ $section->section }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest pl-1">Fecha</label>
                    <input type="text" name="date" id="date" value="{{ $date }}" required
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-slate-700 dark:text-slate-200 outline-none font-bold"
                        placeholder="DD-MM-YYYY">
                </div>

                <div class="md:col-span-2 flex gap-4">
                    <button type="submit"
                        class="flex-1 px-8 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/30">
                        Generar Reporte
                    </button>
                    <a href="{{ route('report.attendance') }}"
                        class="px-8 py-3.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 font-black text-xs uppercase tracking-widest transition-all">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        @if (count($reportData) > 0)
            <!-- Report Table -->
            <div
                class="bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 backdrop-blur-xl rounded-[40px] overflow-hidden shadow-sm">
                <div
                    class="p-8 border-b border-slate-100 dark:border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">
                            Registro de Asistencia - {{ $date }}
                        </h2>
                        <p
                            class="text-sm font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mt-1">
                            {{ $classes->find($classesID)->classes }} | {{ $sections->find($sectionID)->section }}
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr
                                class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700/50">
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Roll</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                    Estudiante</th>
                                @if ($attendance_type == 'subject')
                                    @php $subjects = \App\Models\Subject::where('classesID', $classesID)->get(); @endphp
                                    @foreach ($subjects as $subject)
                                        <th
                                            class="px-6 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                            {{ $subject->subject }}</th>
                                    @endforeach
                                @else
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center">
                                        Estado</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @if ($attendance_type == 'subject')
                                @foreach ($reportData as $studentID => $data)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                                        <td class="px-8 py-5 text-sm font-black text-emerald-600 dark:text-emerald-400">
                                            {{ str_pad($data['roll'], 3, '0', STR_PAD_LEFT) }}</td>
                                        <td class="px-8 py-5">
                                            <div
                                                class="text-sm font-black text-slate-900 dark:text-white tracking-tight capitalize">
                                                {{ $data['name'] }}</div>
                                        </td>
                                        @foreach ($data['subjects'] as $status)
                                            <td class="px-6 py-5 text-center">
                                                @include('components.attendance-badge', [
                                                    'status' => $status,
                                                ])
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($reportData as $data)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                                        <td class="px-8 py-5 text-sm font-black text-emerald-600 dark:text-emerald-400">
                                            {{ str_pad($data['roll'], 3, '0', STR_PAD_LEFT) }}</td>
                                        <td class="px-8 py-5">
                                            <div
                                                class="text-sm font-black text-slate-900 dark:text-white tracking-tight capitalize">
                                                {{ $data['name'] }}</div>
                                        </td>
                                        <td class="px-8 py-5 text-center">
                                            @include('components.attendance-badge', [
                                                'status' => $data['status'],
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-8 bg-slate-50 dark:bg-slate-900/50 flex flex-wrap gap-8 items-center border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white text-[10px] font-black">
                            P</div>
                        <span
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">Presente</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-rose-500 flex items-center justify-center text-white text-[10px] font-black">
                            A</div>
                        <span
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">Ausente</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center text-white text-[10px] font-black">
                            L</div>
                        <span
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">Tarde</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 text-[10px] font-black">
                            -</div>
                        <span
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">Sin
                            registro</span>
                    </div>
                </div>
            </div>
        @else
            <div
                class="bg-white dark:bg-slate-800/30 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-[40px] p-20 text-center">
                <div
                    class="w-24 h-24 rounded-[32px] bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mx-auto mb-6 shadow-inner">
                    <i class="ti ti-report-medical text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Define el periodo</h3>
                <p class="text-slate-500 dark:text-slate-400 font-medium mt-2 max-w-sm mx-auto">Filtrar por clase,
                    sección y fecha para visualizar el reporte detallado de asistencia.</p>
            </div>
        @endif
    </div>
</x-app-layout>
