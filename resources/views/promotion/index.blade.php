<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-trending-up text-indigo-500"></i>
                    Promoción de Estudiantes
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Promueve estudiantes a nuevos grados
                    académicos para el siguiente año escolar.</p>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden mb-10">
            <form action="{{ route('promotion.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-end">
                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-2">Año
                            Escolar Actual</label>
                        <select name="schoolyearID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-6 py-4 text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                            <option value="">Seleccionar año...</option>
                            @foreach ($schoolyears as $year)
                                <option value="{{ $year->schoolyearID }}"
                                    {{ $schoolyearID == $year->schoolyearID ? 'selected' : '' }}>{{ $year->schoolyear }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-2">Clase
                            Actual</label>
                        <select name="classesID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-6 py-4 text-slate-700 dark:text-slate-200 font-bold focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none">
                            <option value="">Seleccionar clase...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full px-8 py-4 bg-slate-900 dark:bg-indigo-600 text-white font-black rounded-2xl shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all">
                            Listar Estudiantes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (!empty($students))
            <form action="{{ route('promotion.promote') }}" method="POST">
                @csrf
                <input type="hidden" name="classesID" value="{{ $classesID }}">
                <input type="hidden" name="schoolyearID" value="{{ $schoolyearID }}">

                <!-- Promotion Destination -->
                @if (Auth::user()->hasPermission('promocion_add'))
                    <div
                        class="rounded-[3rem] bg-indigo-600 text-white p-10 mb-10 shadow-xl shadow-indigo-500/20 relative overflow-hidden group">
                        <div
                            class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000">
                        </div>

                        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-end">
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-black text-indigo-200 uppercase tracking-widest ml-2">Promover
                                    a
                                    Año Escolar</label>
                                <select name="promotion_schoolyearID" required
                                    class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-4 text-white font-bold focus:ring-4 focus:ring-white/20 transition-all outline-none">
                                    <option value="" class="text-slate-900">Seleccionar año destino...</option>
                                    @foreach ($schoolyears as $year)
                                        <option value="{{ $year->schoolyearID }}" class="text-slate-900">
                                            {{ $year->schoolyear }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-black text-indigo-200 uppercase tracking-widest ml-2">Promover
                                    a
                                    Clase</label>
                                <select name="promotion_classesID" required
                                    class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-4 text-white font-bold focus:ring-4 focus:ring-white/20 transition-all outline-none">
                                    <option value="" class="text-slate-900">Seleccionar clase destino...</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->classesID }}" class="text-slate-900">
                                            {{ $class->classes }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-10 py-5 bg-white text-indigo-600 font-black rounded-2xl shadow-2xl hover:bg-slate-50 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest text-xs">
                                    Confirmar Promoción
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Students Table -->
                <div
                    class="rounded-[3rem] bg-white dark:bg-slate-800/20 border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden backdrop-blur-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-900/40">
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] w-20">
                                        <input type="checkbox" id="select-all"
                                            @if (!Auth::user()->hasPermission('promocion_add')) disabled @endif
                                            class="w-5 h-5 rounded-lg border-slate-300 dark:border-slate-600 @if (Auth::user()->hasPermission('promocion_add')) text-indigo-600 focus:ring-indigo-500 @else opacity-50 cursor-not-allowed @endif">
                                    </th>
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                        Estudiante</th>
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                        Roll</th>
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                        DNI</th>
                                    <th
                                        class="px-8 py-6 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">
                                        Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                                @forelse($students as $student)
                                    <tr class="group hover:bg-indigo-500/5 transition-all duration-300">
                                        <td class="px-8 py-6">
                                            <input type="checkbox" name="student_ids[]"
                                                value="{{ $student->studentID }}"
                                                @if (!Auth::user()->hasPermission('promocion_add')) disabled @endif
                                                class="student-checkbox w-5 h-5 rounded-lg border-slate-300 dark:border-slate-600 @if (Auth::user()->hasPermission('promocion_add')) text-indigo-600 focus:ring-indigo-500 @else opacity-50 cursor-not-allowed @endif">
                                        </td>
                                        <td
                                            class="px-8 py-6 text-slate-800 dark:text-slate-100 font-black uppercase tracking-tight">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 overflow-hidden">
                                                    <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                {{ $student->name }}
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 font-mono text-indigo-500 font-bold">#{{ $student->roll }}
                                        </td>
                                        <td
                                            class="px-8 py-6 text-slate-500 dark:text-slate-400 font-medium tracking-widest text-xs">
                                            {{ $student->dni }}</td>
                                        <td class="px-8 py-6">
                                            <span
                                                class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-lg text-[10px] font-black uppercase tracking-widest">Activo</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <i class="ti ti-users text-4xl text-slate-200 mb-4 block"></i>
                                            <p class="text-slate-500 italic">No se encontraron estudiantes para la
                                                selección actual.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        @else
            <div
                class="py-20 text-center rounded-[3rem] border-4 border-dashed border-slate-100 dark:border-slate-800/30 bg-slate-50/30 dark:bg-slate-900/10">
                <i class="ti ti-history text-6xl text-slate-200 mb-6 block"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Selección de Filtros</h3>
                <p class="text-slate-500 max-w-sm mx-auto mt-2 text-sm font-medium">Define el año escolar y la clase
                    para listar a los estudiantes elegibles para promoción.</p>
            </div>
        @endif
    </div>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
</x-app-layout>
