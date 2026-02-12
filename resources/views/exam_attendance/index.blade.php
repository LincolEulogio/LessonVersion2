<x-app-layout>
    <div class="py-10 px-4 sm:px-6 lg:px-8 w-full mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center gap-3">
                    <i class="ti ti-user-search text-emerald-500"></i>
                    Asistencia al Examen
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Registro de puntualidad para estudiantes
                    en evaluaciones programadas.</p>
            </div>
        </div>

        <!-- Filter Card -->
        <div
            class="rounded-[3rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm dark:shadow-none backdrop-blur-xl overflow-hidden mb-10">
            <form action="{{ route('exam_attendance.index') }}" method="GET" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Examen</label>
                        <select name="examID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-200">
                            <option value="">Seleccionar...</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->examID }}" {{ $examID == $exam->examID ? 'selected' : '' }}>
                                    {{ $exam->exam }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Clase</label>
                        <select id="classesID" name="classesID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-200">
                            <option value="">Seleccionar...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->classesID }}"
                                    {{ $classesID == $class->classesID ? 'selected' : '' }}>{{ $class->classes }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Sección</label>
                        <select id="sectionID" name="sectionID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-200 @if (!$classesID) opacity-50 @endif">
                            <option value="">Seleccionar...</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->sectionID }}"
                                    {{ $sectionID == $section->sectionID ? 'selected' : '' }}>{{ $section->section }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Materia</label>
                        <select id="subjectID" name="subjectID" required
                            class="w-full bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-200 @if (!$classesID) opacity-50 @endif">
                            <option value="">Seleccionar...</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->subjectID }}"
                                    {{ $subjectID == $subject->subjectID ? 'selected' : '' }}>{{ $subject->subject }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:col-span-4 mt-6 flex justify-center">
                        <button type="submit"
                            class="px-12 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl shadow-xl transition-all">
                            Cargar Estudiantes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (!empty($students))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($students as $student)
                    @php
                        $current_status = $attendances->get($student->studentID)->eattendance ?? null;
                    @endphp
                    <div class="student-row group p-6 rounded-[2.5rem] bg-white dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:bg-slate-50 dark:hover:bg-emerald-500/5"
                        data-student-id="{{ $student->studentID }}">
                        <div class="flex items-center gap-5 mb-6">
                            <div
                                class="w-16 h-16 rounded-[1.25rem] bg-slate-100 dark:bg-slate-900/40 overflow-hidden ring-4 ring-slate-100 dark:ring-slate-800/50 shadow-inner group-hover:scale-105 transition-transform">
                                <img src="{{ asset($student->photo ? 'storage/images/' . $student->photo : 'uploads/images/default.png') }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <h4
                                    class="text-slate-800 dark:text-slate-100 font-black truncate tracking-tight uppercase leading-tight text-sm">
                                    {{ $student->name }}</h4>
                                <span
                                    class="text-[9px] text-slate-400 font-black uppercase tracking-widest mt-1 block">Roll:
                                    {{ $student->roll }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="saveExamAttendance({{ $student->studentID }}, 'P', this)"
                                class="status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all {{ $current_status == 'P' ? 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 ring-2 ring-emerald-500/20' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-transparent' }}"
                                data-status="P">
                                <i class="ti ti-checkbox text-2xl"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest leading-none">Asiste</span>
                            </button>

                            <button onclick="saveExamAttendance({{ $student->studentID }}, 'A', this)"
                                class="status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all {{ $current_status == 'A' ? 'bg-rose-500 text-white shadow-xl shadow-rose-500/30 ring-2 ring-rose-500/20' : 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 border border-transparent' }}"
                                data-status="A">
                                <i class="ti ti-square-x text-2xl"></i>
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest leading-none">Ausente</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="py-20 text-center rounded-[3rem] border-4 border-dashed border-slate-100 dark:border-slate-800/30 bg-slate-50/30 dark:bg-slate-900/10">
                <i class="ti ti-address-book text-6xl text-slate-200 mb-6 block"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Registro de Asistencia</h3>
                <p class="text-slate-500 max-w-sm mx-auto mt-2 text-sm font-medium">Completa los filtros superiores para
                    cargar la lista de estudiantes y registrar su asistencia al examen.</p>
            </div>
        @endif
    </div>

    <script>
        function saveExamAttendance(studentID, status, btn) {
            const card = btn.closest('.student-row');
            const btns = card.querySelectorAll('.status-btn');

            const activeStyles = {
                P: 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/30 ring-2 ring-emerald-500/20',
                A: 'bg-rose-500 text-white shadow-xl shadow-rose-500/30 ring-2 ring-rose-500/20'
            };

            const idleStyles = {
                P: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 border border-transparent',
                A: 'bg-slate-50 dark:bg-slate-900/50 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 border border-transparent'
            };

            btn.classList.add('animate-pulse');

            fetch("{{ route('exam_attendance.save') }}", {
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
                        studentID: studentID,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.classList.remove('animate-pulse');
                    if (data.success) {
                        btns.forEach(b => {
                            const s = b.getAttribute('data-status');
                            b.className =
                                `status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all ${idleStyles[s]}`;
                        });
                        btn.className =
                            `status-btn p-4 rounded-2xl flex flex-col items-center gap-2 transition-all ${activeStyles[status]}`;
                    }
                })
                .catch(error => {
                    btn.classList.remove('animate-pulse');
                    console.error('Error:', error);
                });
        }
    </script>
</x-app-layout>
