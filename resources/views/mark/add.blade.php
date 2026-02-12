<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-[95%] mx-auto">
        <!-- Header & Filters -->
        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-8 flex items-center gap-3">
            <span
                class="w-10 h-10 rounded-xl bg-white dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400 border border-slate-200 dark:border-orange-500/20 shadow-sm dark:shadow-none">
                <i class="ti ti-checklist text-xl"></i>
            </span>
            Registro de Notas
        </h1>

        <div
            class="mb-8 p-6 rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl">
            <form action="{{ route('mark.add') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div class="space-y-2">
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">Clase</label>
                    <select name="classesID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10 transition-all outline-none cursor-pointer">
                        <option value="">Seleccionar Clase...</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->classesID }}"
                                {{ $classesID == $class->classesID ? 'selected' : '' }}>
                                {{ $class->classes }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">Sección</label>
                    <select name="sectionID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10 transition-all outline-none cursor-pointer">
                        <option value="">Seleccionar Sección...</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->sectionID }}"
                                {{ $sectionID == $section->sectionID ? 'selected' : '' }}>
                                {{ $section->section }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">Materia</label>
                    <select name="subjectID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10 transition-all outline-none cursor-pointer">
                        <option value="">Seleccionar Materia...</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->subjectID }}"
                                {{ $subjectID == $subject->subjectID ? 'selected' : '' }}>
                                {{ $subject->subject }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label
                        class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">Examen</label>
                    <select name="examID" onchange="this.form.submit()"
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/10 transition-all outline-none cursor-pointer">
                        <option value="">Seleccionar Examen...</option>
                        @foreach ($exams as $exam)
                            <option value="{{ $exam->examID }}" {{ $examID == $exam->examID ? 'selected' : '' }}>
                                {{ $exam->exam }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        @if (isset($students) && count($students) > 0)
            <div
                class="rounded-3xl bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-slate-900/50 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                                <th
                                    class="p-6 min-w-[50px] text-center border-b border-r border-slate-100 dark:border-slate-700/50">
                                    #</th>
                                <th
                                    class="p-6 min-w-[250px] border-b border-r border-slate-100 dark:border-slate-700/50">
                                    Estudiante</th>
                                @foreach ($mark_percentages as $percentage)
                                    <th
                                        class="p-4 text-center border-b border-r border-slate-100 dark:border-slate-700/50 min-w-[120px]">
                                        {{ $percentage->markpercentage }}
                                        <span
                                            class="block text-[9px] text-orange-600 dark:text-orange-400 mt-1">({{ $percentage->markpercentage_numeric }}%)</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/30">
                            @foreach ($students as $index => $student)
                                <tr class="group hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors">
                                    <td
                                        class="p-6 text-center text-slate-400 dark:text-slate-500 font-bold border-r border-slate-100 dark:border-slate-700/30">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="p-6 border-r border-slate-100 dark:border-slate-700/30">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-700 overflow-hidden ring-2 ring-slate-100 dark:ring-slate-600">
                                                <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div
                                                    class="text-sm font-bold text-slate-700 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                                    {{ $student->name }}</div>
                                                <div
                                                    class="text-[10px] text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                                    ID:
                                                    {{ $student->studentID }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach ($mark_percentages as $percentage)
                                        <td class="p-3 border-r border-slate-100 dark:border-slate-700/30 text-center">
                                            <input type="number" name="mark_value"
                                                data-student="{{ $student->studentID }}"
                                                data-percentage="{{ $percentage->markpercentageID }}"
                                                value="{{ $student->mark_relations->get($percentage->markpercentageID) }}"
                                                min="0" max="{{ $percentage->markpercentage_numeric }}"
                                                class="mark-input w-20 text-center bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg py-2 text-slate-700 dark:text-slate-200 font-bold focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all placeholder-slate-300 dark:placeholder-slate-600"
                                                placeholder="-">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="fixed bottom-8 right-8 z-50">
                <button type="button" onclick="saveMarks()" id="saveBtn"
                    class="px-8 py-4 bg-orange-600 hover:bg-orange-500 text-white rounded-2xl shadow-lg shadow-orange-600/30 font-black text-xs uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-3">
                    <i class="ti ti-device-floppy text-xl"></i>
                    Guardar Notas
                </button>
            </div>
        @elseif(request('classesID'))
            <div
                class="mt-8 p-12 text-center rounded-3xl border-4 border-dashed border-slate-100 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-900/20 shadow-sm dark:shadow-none">
                <div
                    class="w-24 h-24 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-600 mx-auto mb-6 shadow-inner">
                    <i class="ti ti-users-off text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">No se encontraron estudiantes</h3>
                <p class="text-slate-400 dark:text-slate-500 max-w-sm mx-auto">Asegúrese de haber seleccionado todos los
                    filtros
                    correctamente o añada estudiantes a esta sección.</p>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function saveMarks() {
                const btn = document.getElementById('saveBtn');
                const originalText = btn.innerHTML;
                const inputs = document.querySelectorAll('.mark-input');
                const data = [];

                inputs.forEach(input => {
                    // If value is empty, we might skip it or send it as null depending on requirements.
                    // Sending only filled or '0' values to avoid clearing data unintentionally, 
                    // OR send everything properly if we want to support clearing grades.
                    // Here we send everything to ensure sync.
                    if (input.value !== '') {
                        data.push({
                            mark: input.dataset.percentage + '-' + input.dataset.student,
                            value: input.value
                        });
                    }
                });

                if (data.length === 0) {
                    alert('No hay calificaciones para guardar.');
                    return;
                }

                btn.disabled = true;
                btn.innerHTML = '<i class="ti ti-loader animate-spin text-xl"></i> Guardando...';
                btn.classList.add('opacity-75');

                fetch("{{ route('mark.save') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            examID: '{{ $examID }}',
                            classesID: '{{ $classesID }}',
                            sectionID: '{{ $sectionID }}',
                            subjectID: '{{ $subjectID }}',
                            inputs: data
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            btn.innerHTML = '<i class="ti ti-check text-xl"></i> ¡Guardado!';
                            btn.classList.remove('bg-orange-600', 'hover:bg-orange-500');
                            btn.classList.add('bg-emerald-600', 'hover:bg-emerald-500');
                            setTimeout(() => {
                                btn.innerHTML = originalText;
                                btn.disabled = false;
                                btn.classList.remove('opacity-75', 'bg-emerald-600', 'hover:bg-emerald-500');
                                btn.classList.add('bg-orange-600', 'hover:bg-orange-500');
                            }, 2000);
                        } else {
                            alert('Error: ' + data.message);
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al guardar.');
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    });
            }
        </script>
    @endpush
</x-app-layout>
